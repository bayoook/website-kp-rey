<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $assets_url = "http://localhost/reyy";
        $this->data = array(
            "assets_url" => $assets_url
        );



        error_reporting(error_reporting() & ~E_NOTICE);

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model("model_user", "mus");

        if ($this->session->userdata("login")) {
            $this->session->set_flashdata("msg", "<div id='alert' class='alert alert-warning alert-dismissable'><button class='close' aria-hidden='true' data-dismiss='alert' type='button'>×</button><h4><i class='fa fa-exclamation-circle'></i> Warning</h4><p style='font-size:20px;'>Maaf Anda Harus Login !!!</p></div>");
            redirect("admin");
        }
    }
    public function index($id = null)
    {
        redirect('login');
    }
    public function login()
    {

        $this->data['title'] = "Login";

        $this->load->view('account/header', $this->data);
        $this->load->view('account/login', $this->data);
        $this->load->view('account/footer');
    }
    public function login_auth()
    {

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            if ($user = $this->mus->check_user_login($username, $password)) {
                print_r($user);
                $this->session->set_userdata('userdata', $user);
                $this->session->set_userdata('login', '1');
                redirect('admin');
            } else {
                echo "<script>alert('User tidak ditemukan');window.location.href='';</script>";
            }
        }
    }

    
}
