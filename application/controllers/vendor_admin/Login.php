<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'controllers/Vendor_controller.php';


class Login extends Vendor_controller
{

    public function __construct(){
        parent::__construct();
        $this->login();

    }

    public function index()
    {
//        dmp(32125);
    }

    public function login(){
        if($this->input->post('userName') && $this->input->post('password')){
            $remember = $this->input->post('remember') == 'remember' ? TRUE : FALSE;
            $login = $this->ion_auth->login($this->input->post('userName'), $this->input->post('password'), $remember);
        }
        else{
            $this->load->view('vendor_admin/login');
        }
    }
}