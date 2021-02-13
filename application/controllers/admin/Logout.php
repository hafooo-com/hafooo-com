<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'controllers/Admin_controller.php';


class Logout extends Admin_controller
{

    public function __construct(){
        parent::__construct();
        $this->logout();
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect('/admin/login');
    }


}