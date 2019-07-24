<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$assets_url = "http://localhost/reyy";
		$this->data = array(
			"assets_url" => $assets_url
		);

		error_reporting(error_reporting() & ~E_NOTICE);
		$this->load->model("model_upload", "mdu");
		$this->load->model("model_user", "mus");
		$this->load->model("model_status", "mds");
		$this->load->model("model_history", "mdh");

		$this->load->library('session');
		if (!$this->session->userdata("login")) {
			$this->session->set_flashdata("msg_f", "Maaf anda harus login");
			redirect("account/login");
		}
		if ($this->session->userdata('userdata')['status']!=1){
			redirect("user");
		}
		// print_r($this->session->userdata('userdata')['status']);
		// $this->data['user'] = $this->session->userdata()['userdata']['0'];
		$this->data['user'] = $this->mus->read_user($this->session->userdata('userdata')['id']);
		// $this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
		// if ($this->data['user']['status_name'] != 'Admin') { }
		$this->data['IMPORTANT'] = $this->mus->IMPORTANT();
        $this->data['url'] = 'admin';

		// print_r($_SESSION);
		$this->session->set_flashdata('IMPORTANT_P', $this->data['IMPORTANT']['new']);
		$this->session->set_flashdata('IMPORTANT_H', $this->data['IMPORTANT']['too']);
		$this->session->set_flashdata('IMPORTANT_Y', $this->data['IMPORTANT']['y']);
		$this->data['menu'] = array( //selain dashboard
			array(
				"nama" => "File Upload",
				"icon" => "fa-file-upload",
				"title" => "Upload",
				"url" => "upload"
			),
			array(
				"nama" => "Profile",
				"icon" => "fa-user",
				"title" => "Profile",
				"url" => "profile"
			),
			array(
				"nama" => "User",
				"icon" => "fa-user-circle",
				"title" => "User",
				"url" => "user"
			)
		);
	}
	public function _404()
	{
		$this->data['title'] = 'Page Not Found';
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/404', $this->data);
		$this->load->view('admin/footer');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('account/login');
	}
	public function index()
	{
		redirect('admin/dashboard');
	}
	public function dashboard($type = 'datin', $regional = 'all')
	{
		$this->data['max'] = $this->mdu->get_maximum_date($type);
		$this->data['min'] = $this->mdu->get_minimum_date($type);
		$this->data['type_chart'] = 'horizontalBar';
		if ($this->data['max'] == null)
			$this->data['max'] = '2030-12-31';
		if ($this->data['min'] == null)
			$this->data['min'] = '2000-01-01';
		// $this->data['type_chart'] = 'line';
		$start = $this->session->userdata('filter_cal')['start'];
		$end = $this->session->userdata('filter_cal')['end'];
		if (!(isset($start) && isset($end))) {
			$start = $this->data['min'];
			$end = $this->data['max'];
		}
		$this->data['title'] = "Dashboard " . ucwords($type);
		$this->data['all'] = $this->mdu->get_all_data($type, $start, $end);
		$max_id = $this->maxKey($this->data['all']['regional_list']);
		if ($regional != 'all')
			if ($regional - 1 > $max_id) {
				$this->data['all']['regional_list'][$regional - 1]['witel_list'] = array();
			}
		$this->data['regional'] = $regional;
		$this->data['type'] = $type;
		$this->data['start'] = $start;
		$this->data['end'] = $end;
		// print_r($this->data['all']);
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/dashboard', $this->data);
		$this->load->view('admin/footer');
	}
	public function filter_cal()
	{
		$form = $this->input->post();
		if ($form['start'] > $form['end']) {
			$this->session->set_flashdata('msg_f', 'Tanggal inputan salah');
			redirect($_SERVER['HTTP_REFERER']);
		}
		if ($form['start'] == '' || $form['end'] == '') {
			$this->session->set_flashdata('msg_f', 'Tanggal inputan tidak boleh kosong');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->session->set_userdata('filter_cal', $form);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function upload()
	{
		$this->data['title'] = "Upload";
		$this->data['table'] = $this->mdu->view_all_table();
		$this->data['history'] = $this->mdh->load();
		// print_r($this->data['table']);
		// $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/upload', $this->data);
		$this->load->view('admin/footer');
	}
	public function user()
	{
		$this->data['user_all'] = $this->mus->read_all();
		// $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		// $this->data['status'] = $this->mds->read();
		// print_r($this->data['user']);
		$this->data['title'] = "User";
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/user', $this->data);
		$this->load->view('admin/footer');
	}

	public function upload_file($type)
	{
		// $this->load->library('excel_reader');
		$this->load->library('excel_reader2');
		// upload file xls
		$target = basename($_FILES['uploadfile']['name']);
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target);

		// beri permisi agar file xls dapat di baca
		chmod($_FILES['uploadfile']['name'], 0777);
		// mengambil isi file xls
		$data = new Excel_reader2($_FILES['uploadfile']['name'], false);
		$dataO = new Excel_reader2();
		// print_r($dataO);
		// $data->setOutputEncoding('ASCII,UTF-8,ISO-8859-15');
		// print_r($dataO);
		$hasil = $dataO->read($_FILES['uploadfile']['name']);
		// print_r($hasil);
		unlink($_FILES['uploadfile']['name']);
		if ($hasil == 1076) {
			$this->session->set_flashdata('msg_f', 'File tidak terbaca atau extensi file tidak sesuai');
			redirect('admin/upload');
		}
		// $this->mdu->delete_all('tb_upload');
		ini_set('memory_limit', '-1');
		$cells = $dataO->boundsheets;
		$len = count($cells);
		foreach ($cells as $keys => $rows) {
			if (strcasecmp($rows['name'], $type) == 0) {
				$data = $dataO->sheets[$keys]['cells'];
				$jumlah_baris = $dataO->sheets[$keys]['numRows'];
				$jumlah_kolom = $dataO->sheets[$keys]['numCols'];
				break;
			}
			if ($keys == $len - 1 && strcasecmp($rows['name'], $type) != 0) {
				$this->session->set_flashdata('msg_f', 'Tidak ada data ' . $type . ' di dalam file');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		// $data = $dataO->sheets[0]['cells'];
		// foreach($cells as $keys => $rows)
		// 	// if(strcmp($rows['name'], 'asd'))
		// 		echo strcasecmp($rows['name'], 'datin').'<br>';
		// print_r($dataO->boundsheets);
		// print_r($data);
		// menghitung jumlah baris data yang ada

		// jumlah default data yang berhasil di import
		$berhasil = 0;

		for ($i = 1; $i <= $jumlah_kolom; $i++) {
			if (strcasecmp($data[1][$i], "Customer_Name") == 0) $cust_name_col = $i;
			if (strcasecmp($data[1][$i], "Customer_Segment") == 0) $cust_segment_col = $i;
			if (strcasecmp($data[1][$i], "SID_Customer") == 0) $serv_id_col = $i;
			// if (strcasecmp($data[1][$i], "Service No") == 0) $serv_no_col = $i;
			if (strcasecmp($data[1][$i], "Category Cust") == 0) $top_prio_col = $i;
			if (strcasecmp($data[1][$i], "TTR_Customer") == 0) $ttr_cust_col = $i;
			if (strcasecmp($data[1][$i], "COMPLIANCE") == 0) $compliance_col = $i;
			if (strcasecmp($data[1][$i], "Witel") == 0) $witel_col = $i;
			if (strcasecmp($data[1][$i], "Regional") == 0) $regional_col = $i;
			if (strcasecmp($data[1][$i], "exclude") == 0) $exclude_col = $i;
			// if (strcasecmp($data[1][$i], "GAMAS") == 0) $gamas_col = $i;
			if (strcasecmp($data[1][$i], "Status_Date") == 0) $report_date_col = $i;
		}
		$id_history = array();
		for ($i = 2; $i <= $jumlah_baris; $i++) {
			// print_r($data[$i]);
			// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

			if (isset($data[$i][$cust_name_col])) $cust_name = $data[$i][$cust_name_col];
			else $cust_name = "";
			if (isset($data[$i][$cust_segment_col])) $cust_segment = $data[$i][$cust_segment_col];
			else $cust_segment = "";
			if (isset($data[$i][$serv_id_col])) $serv_id = $data[$i][$serv_id_col];
			else $serv_id = "";
			if (isset($data[$i][$top_prio_col])) $top_prio = $data[$i][$top_prio_col];
			else $top_prio = "";
			if (isset($data[$i][$ttr_cust_col])) $ttr_cust = $data[$i][$ttr_cust_col];
			else $ttr_cust = "";
			if (isset($data[$i][$compliance_col])) $compliance = $data[$i][$compliance_col];
			else $compliance = "";
			if (isset($data[$i][$witel_col])) $witel = $data[$i][$witel_col];
			else $witel = "";
			if (isset($data[$i][$regional_col])) $regional = $data[$i][$regional_col];
			else $regional = "";
			if (isset($data[$i][$exclude_col])) $exclude = $data[$i][$exclude_col];
			else $exclude = "";
			if (isset($data[$i][$report_date_col])) {
				$report_date = $data[$i][$report_date_col];
				$report_date = strtotime($report_date);
				$report_date = date('Y-m-d H:i:s', $report_date);
			} else $report_date = "";
			$data_save = array(
				'cust_name' => $cust_name,
				'cust_segment' => $cust_segment,
				'serv_id' => $serv_id,
				'top_prio' => $top_prio,
				'ttr_cust' => $ttr_cust,
				'compliance' => $compliance,
				'witel' => $witel,
				'regional' => $regional,
				'exclude' => $exclude,
				'type' => $type,
				'status' => 'show',
				'report_date' => $report_date
			);
			$data_save = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $data_save);
			$berhasil++;

			// print_r($data[$i][9]);
			array_push($id_history, $this->mdu->save($data_save));
		}
		// hapus kembali file .xls yang di upload tadi
		if ($berhasil != 0)
			$this->session->set_flashdata('msg_s', "Berhasil upload $berhasil data");
		else {
			$this->session->set_flashdata('msg_f', "Gagal upload data");
			redirect($_SERVER['HTTP_REFERER']);
		}
		// $tanggal = '07-12-2017 09:43:13';
		// $tanggal = strtotime($tanggal);
		// $tanggal = date('Y-m-d H:i:s',$tanggal);
		$data_history = array(
			'awal' => min($id_history),
			'akhir' => max($id_history),
			'nama_file' => $target,
			// 'tanggal' => $tanggal
			'type' => $type,
			'status' => 'view'
		);
		// print_r($data_history);
		$this->mdh->save($data_history);
		redirect('admin/dashboard/' . $type);
	}
	public function ubah($type, $id = null, $photo = null)
	{
		// $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		if ($photo != null) {
			$this->data['photo'] = $photo;
			$this->session->set_flashdata("photo_se", $photo);
			redirect('admin/ubah/' . $type . '/' . $id);
		}
		if ($type == 'edit') {
			$this->data['title'] = "Edit User";
			$this->data['user_edit'] = $this->mus->read_user($id);
		} else if ($type == 'tambah')
			$this->data['title'] = "Tambah User";
		$this->data['status'] = $this->mds->read();
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/tambah_user', $this->data);
		$this->load->view('admin/footer');
	}
	function proses_tambah_user()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('retype_password', 'Confirm Password', 'required|matches[password]');
		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_f', validation_errors());
			return redirect('admin/ubah/tambah');
		} else {
			$form = $this->input->post();
			if ($this->mus->check_user_exist($form['username'], $form['email'])) {
				$akun = array(
					'username' => $form['username'],
					'password' => md5($form['password']),
					'email' => $form['email'],
					'first_name' => $form['first_name'],
					'last_name' => $form['last_name'],
					'alamat' => $form['alamat'],
					'no_telp' => $form['no_telp'],
					'photo' => $form['photo'],
					'status' => $form['status']
				);
				if ($id = $this->mus->save($akun)) {
					$form['photo'] = $this->pindah_gambar($_FILES, $id);
					if ($form['photo'] != 'user' . $id . '_')
						$this->mus->update(array('photo' => $form['photo']), array('id' => $id));
					$this->session->set_flashdata("msg_s", 'Berhasil Tambah User');
					redirect(base_url('admin/user'));
				} else {
					$this->session->set_flashdata("msg_f", 'Gagal Tambah User');
					redirect(base_url('admin/ubah/tambah'));
				}
			} else {
				$this->session->set_flashdata('msg_f', 'Username atau email sudah terdaftar');
				return redirect('admin/ubah/tambah');
			}
		}
	}
	function proses_edit_user($id, $type = null)
	{
		$id_status = $this->mds->read_id($this->mus->read_user($id)['status']);
		// upload file xls
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		if ($type == 'profile') {
			$gagal = 'admin/profile';
			$sukses = $gagal;
		} else {
			$gagal = 'admin/ubah/edit/' . $id;
			$sukses = 'admin/user';
		}
		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_f', validation_errors());
			redirect($gagal);
		} else {
			$form = $this->input->post();
			$akun = array(
				'username' => $form['username'],
				'email' => $form['email'],
				'first_name' => $form['first_name'],
				'last_name' => $form['last_name'],
				'alamat' => $form['alamat'],
				'no_telp' => $form['no_telp'],
				'photo' => $form['photo'],
				'status' => ""
			);
			if ($type == 'profile') {
				$akun['status'] = $id_status;
			} else {
				$akun['status'] = $form['status'];
			}
			// print_r($this->input->post());
			//print_r($akun);
			$id_edit = array(
				'id' => $id
			);
			if ($this->mus->check_user_exist($form['username'], $form['email'], $id)) {
				if ($this->mus->update($akun, $id_edit) !== null) {
					$this->session->set_flashdata("msg_s", 'Sukses update data');
					redirect($sukses);
				} else {
					$this->session->set_flashdata("msg_f", 'Gagal update profile');
					redirect($gagal);
				}
			} else {
				$this->session->set_flashdata("msg_f", 'Username atau email sudah terdaftar');
				$this->session->set_flashdata("feedback", 'Username atau email sudah terdaftar');
				redirect($gagal);
			}
			redirect($sukses);
		}
	}


	public function profile($photo = null)
	{
		if ($photo != null) {
			// $this->data['photo'] = $photo;
			$this->session->set_flashdata("photo_se", $photo);
			redirect('admin/profile');
		}
		$this->data['title'] = 'Profile';
		// $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		// $this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/profile', $this->data);
		$this->load->view('admin/footer');
	}
	public function delete_user($id)
	{
		$this->mus->delete($id);
		$this->session->set_flashdata("msg_s", "Berhasil hapus user");
		redirect('admin/user');
	}
	public function delete_image($id)
	{
		$hasil = $this->mus->delete_image($id);
		if ($hasil == 0)
			$this->session->set_flashdata("msg_f", "Gagal hapus gambar");
		else
			$this->session->set_flashdata("msg_s", "Berhasil hapus gambar");
		// redirect('admin/ubah/edit/');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function test($regional = 1, $witel = 1)
	{
		// $this->data['all'] = $this->mdu->get_all_data();
		// $this->data['regional'] = $regional;
		// $this->data['witel'] = $witel;
		// $this->data['title'] = "Dashboard Datin";
		// $this->data['kota']['all'] = $this->mdu->count_all_a();
		// $this->data['kota']['bandung'] = $this->mdu->count_all('(bandung)', 'bandung');
		// $this->data['kota']['bandungbrt'] = $this->mdu->count_all('Bandung Barat', 'bandungbrt');
		// $this->data['kota']['cirebon'] = $this->mdu->count_all('cirebon', 'cirebon');
		// $this->data['kota']['tasikmalaya'] = $this->mdu->count_all('tasikmalaya', 'tasikmalaya');
		// $this->data['kota']['sukabumi'] = $this->mdu->count_all('sukabumi', 'sukabumi');
		// $this->data['kota']['karawang'] = $this->mdu->count_all('karawang', 'karawang');
		// $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/test', $this->data);
		$this->load->view('admin/footer');
		// print_r($this->data['all']);

	}
	public function test_2($type = 'datin')
	{
		$this->data['max'] = $this->mdu->get_maximum_date($type);
		$this->data['min'] = $this->mdu->get_minimum_date($type);
		$start = $this->session->userdata('filter_cal')['start'];
		$end = $this->session->userdata('filter_cal')['end'];
		if (!(isset($start) && isset($end))) {
			$start = $this->data['min'];
			$end = $this->data['max'];
		}
		$this->data['title'] = "Dashboard " . ucwords($type);
		$this->data['all'] = $this->mdu->get_all_data($type, $start, $end);
		$this->data['all']['mk_regional'] = $this->maxKey($this->data['all']['regional_list']);
		print_r($this->data['all']);
	}

	function pindah_gambar($files, $id)
	{
		$target = basename($files['photo']['name']);
		$name = "user$id" . "_$target";
		move_uploaded_file($files['photo']['tmp_name'], "./uploads/$name");
		return $name;
	}
	function ganti_gambar($id, $type = null)
	{
		$this->mus->update(array('photo' => null), $id);
		$target = $this->pindah_gambar($_FILES, $id);
		$this->session->set_flashdata($target);
		if ($id == 0)
			redirect('admin/user/');
		if ($type == null)
			redirect('admin/profile/' . $target);
		else
			redirect('admin/ubah/' . $type . '/' . $id . '/' . $target);
	}
	public function delete_history($id)
	{
		$this->mdh->delete_where_id($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function hide_table($id, $type = 'hide')
	{
		$history = $this->mdh->load_by_id($id);
		$this->mdu->hide_table(array('id >=' => $history['awal'], 'id<=' => $history['akhir']), $type);
		$this->mdh->hide_table($id, $type);
		redirect($_SERVER['HTTP_REFERER']);
	}
	function maxKey($arr)
	{
		$maxKey = key($arr);
		foreach ($arr as $k => $v) {
			if ($k > $maxKey) $maxKey = $k;
		}
		return $maxKey;
	}
}
