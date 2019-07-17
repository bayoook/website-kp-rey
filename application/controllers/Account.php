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
                $this->session->set_flashdata("msg_f", "Username atau password anda tidak ditemukan");
                redirect('account/login');
            }
        }
    }
}