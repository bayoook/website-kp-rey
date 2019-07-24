<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $this->data['url'] = 'user';
        if (!$this->session->userdata("login")) {
            $this->session->set_flashdata("msg_f", "Maaf anda harus login");
            redirect("account/login");
        }
        if ($this->session->userdata('userdata')['status'] != 2) {
            $this->session->set_flashdata("msg_f", "Maaf akun anda belum diaktifkan");
            $this->session->set_userdata('userdata','');
            $this->session->set_userdata('login','0');
            redirect('account/login');
        }
        // print_r($this->session->userdata('userdata')['status']);
        // $this->data['user'] = $this->session->userdata()['userdata']['0'];
        $this->data['user'] = $this->mus->read_user($this->session->userdata('userdata')['id']);
        // $this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
        // if ($this->data['user']['status_name'] != 'Admin') { }
        $this->data['IMPORTANT'] = $this->mus->IMPORTANT();
        // print_r($_SESSION);
        $this->session->set_flashdata('IMPORTANT_P', $this->data['IMPORTANT']['new']);
        $this->session->set_flashdata('IMPORTANT_H', $this->data['IMPORTANT']['too']);
        $this->session->set_flashdata('IMPORTANT_Y', $this->data['IMPORTANT']['y']);
        $this->data['menu'] = array( //selain dashboard
            array(
                "nama" => "Profile",
                "icon" => "fa-user",
                "title" => "Profile",
                "url" => "profile"
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
        redirect('user/dashboard');
    }
    public function dashboard($type = 'datin', $regional = 'all')
    {
        // print_r($this->session->userdata());
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
    function proses_edit_user($id, $type = null)
    {
        $id_status = $this->mds->read_id($this->mus->read_user($id)['status']);
        // upload file xls
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');

        $gagal = 'user/profile';
        $sukses = $gagal;
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
            $akun['status'] = $id_status;
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
            redirect('user/profile');
        }
        $this->data['title'] = 'Profile';
        // $this->data['user'] = $this->mus->read_user($this->data['user']['id']);
        // $this->data['user']['status_name'] = $this->mds->read_status($this->data['user']['status']);
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/profile', $this->data);
        $this->load->view('admin/footer');
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
            redirect('user/user/');
        if ($type == null)
            redirect('user/profile/' . $target);
        else
            redirect('user/ubah/' . $type . '/' . $id . '/' . $target);
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
