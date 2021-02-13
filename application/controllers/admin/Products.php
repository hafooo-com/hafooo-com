<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require 'Vendor_controller.php';
require APPPATH . 'controllers/Admin_controller.php';


class Products extends Admin_controller
{

    public $data = array();

    public function __construct(){
        parent::__construct();
        $this->load->model('vendor_admin/Products_model');
        $this->load->model('vendor_admin/Vendor_model');
        $this->data['languages'] = $this->Vendor_model->getActiveLanguages();
    }


    public function index(){

    }


    public function products_list(){
        $this->setDictionary('admin/products/products_list');
        $this->load->view('vendor_admin/_header');
        $this->load->view('vendor_admin/products/products_list', $output);
        $this->load->view('vendor_admin/_footer');
    }


    public function add_product_form(){
//        dmp(ACTIVE_LANGUAGES);
        $this->data['css'] = array(
            '/assets/adminlte/plugins/select2/css/select2.min.css',
            '/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            '/assets/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
            '/assets/adminlte/plugins/summernote/summernote-bs4.css',
        );
        $this->data['js'] = array(
            '/assets/adminlte/plugins/select2/js/select2.full.min.js',
            '/assets/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
            '/assets/adminlte/plugins/summernote/summernote-bs4.min.js',
            '/js/vendor_admin/add_product_form.js',
        );
        $this->data['productCategoriesTree'] = $this->Products_model->getProductCategoriesTree();
//        dmp($this->data);
        $this->load->view('vendor_admin/_header', $this->data);
        $this->load->view('vendor_admin/products/add_product_form', $this->data);
        $this->load->view('vendor_admin/_footer', $this->data);
    }


    public function _______add_product_form($parent_id = null){
        $this->load->library('grocery_CRUD');
        $c = new grocery_CRUD();
        $parent_id = 1;
        $c->where( empty($parent_id) ? 'parentPageID IS NULL' : array('parentPageID' => $parent_id) );
        $c->set_table('page');
        $c->order_by('sort');
        $c->set_subject('Webpage');
        $c->columns('pageID', 'pageUri','pageType','state','allParentPageIDs', 'parentPageID');
        $c->change_field_type('parentPageID', 'hidden',$parent_id);
        $c->callback_column('menu_title',array($this,'_callback_webpage_url'));
        $output = $c->render();
//        $this->grocery_crud->render();
//        $output = $this->grocery_crud->render();
//        dmp($output);
//        $c->_view_output($output);
    }
    public function _callback_webpage_url($value, $row)
    {
        return "<a href='".site_url('admin/webpages/'.$row->id)."'>$value</a>";
    }


    public function add_product(){

    }


    public function edit_product(){

    }

}