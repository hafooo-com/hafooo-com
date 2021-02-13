<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require 'Vendor_controller.php';
require APPPATH . 'controllers/Vendor_controller.php';

class Dashboard extends Vendor_controller
{

    public function __construct(){
        parent::__construct();
        $this->setDictionary('vendor/admin/dashboard');
        $this->data['pageTitle'] = 'VENDOR_ADMIN_PRODUCT_EDIT_PAGE_TITLE';
    }


    public function index(){
        $this->load->view('vendor_admin/_header', $this->data);
        $this->load->view('vendor_admin/dashboard', $this->data);
        $this->load->view('vendor_admin/_footer', $this->data);
    }


}