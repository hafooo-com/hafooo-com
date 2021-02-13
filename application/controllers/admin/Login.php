<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'controllers/Admin_controller.php';


class Login extends Admin_controller
{

    public function __construct(){
        parent::__construct();
        if($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)){
            redirect('/admin');
        }
        else{
            $this->load->view('admin/login');
        }
        $this->login();
    }

    public function login(){
//        if($this->input->post('userName') && $this->input->post('password')){
//            $remember = $this->input->post('remember') == 'remember' ? TRUE : FALSE;
//            $login = $this->ion_auth->login($this->input->post('userName'), $this->input->post('password'), $remember);
//        }
//        else{
//            $this->load->view('admin/login');
//        }
    }
}