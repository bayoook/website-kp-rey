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

		$this->load->library('session');
		if (!$this->session->userdata("login")) {
			$this->session->set_flashdata("msg_f", "Maaf anda harus login");
			redirect("account/login");
		}
		$this->data['user'] = $this->session->userdata()['userdata']['0'];
		$this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
		if ($this->data['user']['status_name'] != 'Admin') { }
		$this->data['IMPORTANT'] = $this->mus->IMPORTANT();

		// print_r($_SESSION);
		$this->session->set_flashdata('IMPORTANT_P', $this->data['IMPORTANT']['new']);
		$this->session->set_flashdata('IMPORTANT_H', $this->data['IMPORTANT']['too']);
		$this->session->set_flashdata('IMPORTANT_Y', $this->data['IMPORTANT']['y']);
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
	public function dashboard($sel = null)
	{
		if ($sel == null)
			$sel = 'bandung';
		if ($sel == 'success')
			$sel = 'bandung';
		$this->data['sel'] = $sel;
		$this->data['title'] = "Dashboard";
		$this->data['kota']['all'] = $this->mdu->count_all_a();
		$this->data['kota']['bandung'] = $this->mdu->count_all('(bandung)', 'bandung');
		$this->data['kota']['bandungbrt'] = $this->mdu->count_all('Bandung Barat', 'bandungbrt');
		$this->data['kota']['cirebon'] = $this->mdu->count_all('cirebon', 'cirebon');
		$this->data['kota']['tasikmalaya'] = $this->mdu->count_all('tasikmalaya', 'tasikmalaya');
		$this->data['kota']['sukabumi'] = $this->mdu->count_all('sukabumi', 'sukabumi');
		$this->data['kota']['karawang'] = $this->mdu->count_all('karawang', 'karawang');
		$this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		foreach ($this->data['kota'] as $rows) {
			if ($sel == $rows['Nick']) {
				$this->data['nama'] = $rows['Nama'];
				$this->data['dbs'] = $rows['AVG_DBS'];
				$this->data['des'] = $rows['AVG_DES'];
				$this->data['dgs'] = $rows['AVG_DGS'];
				$this->data['comply'] = $rows['COMPLY'];
				$this->data['nComply'] = $rows['NOT_COMPLY'];
			}
		}
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/dashboard', $this->data);
		$this->load->view('admin/footer');
	}
	public function upload()
	{
		$this->data['title'] = "Upload";
		$this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/upload', $this->data);
		$this->load->view('admin/footer');
	}
	public function user()
	{
		$this->data['user_all'] = $this->mus->read_all();
		$this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		$this->data['status'] = $this->mds->read();
		// print_r($this->data['user']);
		$this->data['title'] = "User";
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/user', $this->data);
		$this->load->view('admin/footer');
	}

	public function upload_file()
	{
		$this->load->library('excel_reader');
		// upload file xls
		$target = basename($_FILES['uploadfile']['name']);
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target);

		// beri permisi agar file xls dapat di baca
		chmod($_FILES['uploadfile']['name'], 0777);
		// mengambil isi file xls
		$data = new Excel_reader($_FILES['uploadfile']['name'], false);
		$dataO = new Excel_reader();
		//$data->setOutputEncoding('CPa25a');
		// print_r($dataO);
		$hasil = $dataO->read($_FILES['uploadfile']['name']);
		if ($hasil == 1076) {
			$this->session->set_flashdata('msg_f', 'Gagal upload file, silahkan pilih file .xls');
			redirect('admin/upload');
		}
		$this->mdu->delete_all('tb_upload');
		ini_set('memory_limit', '-1');
		$data = $dataO->sheets[0]['cells'];
		//print_r($data);
		// menghitung jumlah baris data yang ada
		$jumlah_baris = $dataO->sheets[0]['numRows'];
		$jumlah_kolom = $dataO->sheets[0]['numCols'];
		// jumlah default data yang berhasil di import
		$berhasil = 0;

		for ($i = 1; $i <= $jumlah_kolom; $i++) {
			if ($data[1][$i] == "Customer Name") $cust_name_col = $i;
			if ($data[1][$i] == "Customer Segment") $cust_segment_col = $i;
			if ($data[1][$i] == "Service ID") $serv_id_col = $i;
			if ($data[1][$i] == "Service No") $serv_no_col = $i;
			if ($data[1][$i] == "Top Priority") $top_prio_col = $i;
			if ($data[1][$i] == "TTR Customer") $ttr_cust_col = $i;
			if ($data[1][$i] == "COMPLIANCE") $compliance_col = $i;
			if ($data[1][$i] == "Witel") $witel_col = $i;
			if ($data[1][$i] == "Regional") $regional_col = $i;
			if ($data[1][$i] == "exclude") $exclude_col = $i;
			if ($data[1][$i] == "GAMAS") $gamas_col = $i;
		}
		for ($i = 2; $i <= $jumlah_baris; $i++) {
			// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

			if (isset($data[$i][$cust_name_col])) $cust_name = $data[$i][$cust_name_col];
			else $cust_name = "";
			if (isset($data[$i][$cust_segment_col])) $cust_segment = $data[$i][$cust_segment_col];
			else $cust_segment = "";
			if (isset($data[$i][$serv_id_col])) $serv_id = $data[$i][$serv_id_col];
			else $serv_id = "";
			if (isset($data[$i][$serv_no_col])) $serv_no = $data[$i][$serv_no_col];
			else $serv_no = "";
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
			if (isset($data[$i][$gamas_col])) $gamas = $data[$i][$gamas_col];
			else $gamas = "";


			$cust_name = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $cust_name);
			$cust_segment = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $cust_segment);
			$serv_id = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $serv_id);
			$serv_no = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $serv_no);
			$top_prio = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $top_prio);
			$ttr_cust = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $ttr_cust);
			$compliance = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $compliance);
			$witel = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $witel);
			$regional = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $regional);
			$exclude = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $exclude);
			$gamas = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $gamas);

			$data_save = array(
				'cust_name' => $cust_name,
				'cust_segment' => $cust_segment,
				'serv_id' => $serv_id,
				'serv_no' => $serv_no,
				'top_prio' => $top_prio,
				'ttr_cust' => $ttr_cust,
				'compliance' => $compliance,
				'witel' => $witel,
				'regional' => $regional,
				'exclude' => $exclude,
				'gamas' => $gamas
			);
			$berhasil++;
			$this->mdu->save($data_save);
		}
		// hapus kembali file .xls yang di upload tadi
		unlink($_FILES['uploadfile']['name']);
		$this->session->set_flashdata('msg_s', "Berhasil Upload $berhasil data");
		redirect('admin/dashboard');
	}
	public function ubah($type, $id = null, $photo = null)
	{
		$this->data['user'] = $this->mus->read_user($this->data['user']['id']);
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
		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_f', validation_errors());
			redirect('admin/ubah/edit/' . $id);
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

			print_r($this->input->post());
			if ($type == 'profile') {
				$akun['status'] = $id_status;
				$gagal = 'admin/profile';
				$sukses = $gagal;
			} else {
				$akun['status'] = $form['status'];
				$gagal = 'admin/ubah/edit/' . $id;
				$sukses = 'admin/user';
			}
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
		$this->data['user'] = $this->mus->read_user($this->data['user']['id']);
		$this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
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
	public function test($page = null)
	{
		$this->load->view('admin/header', $this->data);
		$this->mdu->backup('upload');
		// $this->load->view('admin/test', $this->data);
		$this->load->view('admin/footer');
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
	public function do_upload()
	{ }
}