<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require 'Vendor_controller.php';
require APPPATH . 'controllers/Admin_controller.php';

class Dashboard extends Admin_controller
{

    public function __construct(){
        parent::__construct();
    }


    public function index(){
        $this->load->view('admin/_header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/_footer');
    }


}