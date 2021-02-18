<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'controllers/Vendor_controller.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Products extends Vendor_controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('vendor_admin/Products_model');
        $this->load->model('vendor_admin/Vendor_model');
        $this->data['languages'] = $this->Vendor_model->getActiveLanguages();
    }


    public function index(){

    }


    public function products_list(){
        $this->setDictionary('vendor/admin/products_list');
        $this->data['css'] = array(
            '/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            '/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
        );
        $this->data['js'] = array(
            '/assets/adminlte/plugins/datatables/jquery.dataTables.min.js',
            '/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
            '/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js',
            '/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
            '/assets/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
            '/js/vendor_admin/product_list.min.js',
        );
        $this->data['productsList'] = $this->Products_model->getProductsByVendor( $this->data['vendor']['vendorID'] );
        $this->data['pageTitle'] = 'VENDOR_ADMIN_PRODUCTS_LIST_PAGE_TITLE';
        $this->load->view('vendor_admin/_header', $this->data);
        $this->load->view('vendor_admin/products/products_list', $this->data);
        $this->load->view('vendor_admin/_footer', $this->data);
    }


    public function product_edit(){
        $pageID = $this->uri->segment(4);
        $this->setDictionary('vendor/admin/product_edit');
        $this->data['css'] = array(
            '/assets/adminlte/plugins/ekko-lightbox/ekko-lightbox.css',
            '/assets/adminlte/plugins/select2/css/select2.min.css',
            '/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            '/assets/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
            '/assets/adminlte/plugins/summernote/summernote-bs4.css',
            '/assets/adminlte/plugins/toastr/toastr.min.css',
        );
        $this->data['js'] = array(
            '/assets/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js',
            '/assets/adminlte/plugins/select2/js/select2.full.min.js',
            '/assets/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
            '/assets/adminlte/plugins/summernote/summernote-bs4.min.js',
            '/assets/adminlte/plugins/toastr/toastr.min.js',
            '/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
            '/assets/psfpro-bootstrap-html5sortable-e43c2ad/jquery.sortable.min.js',
            '/js/vendor_admin/add_product_form.min.js',
            '/js/vendor_admin/price_calc.min.js',
            '/js/vendor_admin/product_edit.min.js',
        );
//            '/assets/dropzone-5.7.0/dropzone.css',
//            '/assets/dropzone-5.7.0/dropzone.min.js',

//
        $this->data['pageTitle'] = 'VENDOR_ADMIN_PRODUCT_EDIT_PAGE_TITLE';
        $this->data['productCategoriesTree'] = $this->Products_model->getProductCategoriesTree();
        $this->data['productData'] = $this->Products_model->getProductData($pageID);
        $this->data['productImages'] = $this->Products_model->getProductImages($pageID);
//        dmp($this->data);
        $this->load->view('vendor_admin/_header', $this->data);
        $this->load->view('vendor_admin/products/product_edit', $this->data);
        $this->load->view('vendor_admin/_footer', $this->data);
//        dmp($this->data);
//        die;
    }


    public function add_product_form(){
        $this->setDictionary('vendor/admin/add_product');
        $this->data['pageTitle'] = 'VENDOR_ADMIN_ADD_PRODUCT_PAGE_TITLE';
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
            '/assets/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
            '/js/vendor_admin/add_product_form.min.js',
        );
        $this->data['productCategoriesTree'] = $this->Products_model->getProductCategoriesTree();
//        dmp($this->data);
        $this->load->view('vendor_admin/_header', $this->data);
        $this->load->view('vendor_admin/products/add_product_form', $this->data);
        $this->load->view('vendor_admin/_footer', $this->data);
    }



    public function add_product(){
        $this->setDictionary('vendor/admin/add_product');
        $this->form_validation->set_rules('language', 'language', 'required');
        $this->form_validation->set_rules('parentPage', 'parentPage', 'required');
        $this->form_validation->set_rules('pageName', 'pageName', 'required|min_length[3]|max_length[300]');
        $this->form_validation->set_rules('metaTitle', 'metaTitle', 'required|min_length[10]|max_length[300]');
        $this->form_validation->set_rules('metaDescription', 'metaDescription', 'required|min_length[10]|max_length[300]');
        $this->form_validation->set_rules('productDescription', 'productDescription', 'required|min_length[10]|max_length[10000]');
        $validation_errors = $this->form_validation->run();

        if(!$validation_errors){
            $validation_errors = validation_errors();
            $errorFields = array();
            $httpQuery = http_build_query( $this->input->post() );
            if(strpos($validation_errors,'language') !== false) {$errorFields[] = 'language';}
            if(strpos($validation_errors,'parentPage') !== false) {$errorFields[] = 'parentPage';}
            if(strpos($validation_errors,'pageName') !== false) {$errorFields[] = 'pageName';}
            if(strpos($validation_errors,'metaTitle') !== false) {$errorFields[] = 'metaTitle';}
            if(strpos($validation_errors,'metaDescription') !== false) {$errorFields[] = 'metaDescription';}
            if(strpos($validation_errors,'productDescription') !== false) {$errorFields[] = 'productDescription';}
            $errorFields = implode( '-', $errorFields );

            $url = '/vendor_admin/products/add_product_form?alert=danger&message=' . urlencode($this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_ALERT_OPERATION_FAILED')) . '&errorFields=' . $errorFields . '&' . $httpQuery;
            redirect( $url );
        }

        list($throw, $parentPageID) = explode('-', $this->input->post('parentPage'));
        $allParentPageIDs = str_replace('-', ',', $this->input->post('parentPage'));
        $pageUri = $this->Products_model->createProductUrl($this->input->post('pageName'), $parentPageID);
        $data['page'] = array(
            'parentPageID' => $parentPageID,
            'allParentPageIDs' => $allParentPageIDs,
            'pageUri' => $pageUri,
            'pageType' => 'PRODUCT_VIEW',
            'state' => 'INACTIVE',
        );
        $data['product'] = array(
            'vendorID' => $this->data['vendor']['vendorID'],
            'packageWeight' => '',
            'packageLength' => '',
            'packageWidth' => '',
            'packageHeight' => '',
            'productMedia' => json_encode( new stdClass() ),
            'mainImage' => '',
            'productType' => $this->input->post('productType'),
        );
        $data['pageTranslation'] = array(
            'lang' => $this->input->post('language'),
            'pageName' => $this->input->post('pageName'),
            'metaTitle' => $this->input->post('metaTitle'),
            'metaDescription' => $this->input->post('metaDescription'),
        );
        $data['productTranslation'] = array(
            'lang' => $this->input->post('language'),
            'productDescription' => $this->input->post('productDescription'),
        );
        $product = $this->Products_model->createProduct($data);
//        dmp($data);
        $url = '/vendor_admin/products/product_edit/' . $product . '?alert=success&message=asdasd df asdf asdf asdf as';
        redirect($url);
    }


    public function update_product_basic_data(){
        $pageID = $this->input->post('pageID');
        $this->setDictionary('vendor/admin/product_edit');
        $this->form_validation->set_rules('parentPage', 'parentPage', 'required');
        $this->form_validation->set_rules('pageName', 'pageName', 'required|min_length[3]|max_length[300]');
        $this->form_validation->set_rules('metaTitle', 'metaTitle', 'required|min_length[10]|max_length[300]');
        $this->form_validation->set_rules('metaDescription', 'metaDescription', 'required|min_length[10]|max_length[300]');
        $this->form_validation->set_rules('productDescription', 'productDescription', 'required|min_length[10]|max_length[10000]');
        $validation_errors = $this->form_validation->run();

        if(!$validation_errors){
            $validation_errors = validation_errors();
            $errorFields = array();
            $httpQuery = http_build_query( $this->input->post() );
            if(strpos($validation_errors,'parentPage') !== false) {$errorFields[] = 'parentPage';}
            if(strpos($validation_errors,'pageName') !== false) {$errorFields[] = 'pageName';}
            if(strpos($validation_errors,'metaTitle') !== false) {$errorFields[] = 'metaTitle';}
            if(strpos($validation_errors,'metaDescription') !== false) {$errorFields[] = 'metaDescription';}
            if(strpos($validation_errors,'productDescription') !== false) {$errorFields[] = 'productDescription';}
            $errorFields = implode( '-', $errorFields );

            $url = '/vendor_admin/products/product_edit/?alert=danger&message=' . urlencode($this->lang->line('VENDOR_ADMIN_UPDATE_PRODUCT_ALERT_OPERATION_FAILED')) . '&errorFields=' . $errorFields . '&' . $httpQuery;
            redirect( $url );
        }

        list($throw, $parentPageID) = explode('-', $this->input->post('parentPage'));
        $allParentPageIDs = str_replace('-', ',', $this->input->post('parentPage'));
        $pageUri = $this->Products_model->createProductUrl($this->input->post('pageName'), $parentPageID);
        $data['page'] = array(
            'parentPageID' => $parentPageID,
            'allParentPageIDs' => $allParentPageIDs,
            'pageUri' => $pageUri,
            'pageType' => 'PRODUCT_VIEW',
            'state' => 'INACTIVE',
        );
        $data['product'] = array(
            'vendorID' => $this->data['vendor']['vendorID'],
            'packageWeight' => '',
            'packageLength' => '',
            'packageWidth' => '',
            'packageHeight' => '',
            'productMedia' => json_encode( new stdClass() ),
            'mainImage' => '',
            'productType' => '',
            'productType' => $this->input->post('productType'),
        );
        $data['pageTranslation'] = array(
            'lang' => $this->input->post('language'),
            'pageName' => $this->input->post('pageName'),
            'metaTitle' => $this->input->post('metaTitle'),
            'metaDescription' => $this->input->post('metaDescription'),
        );
        $data['productTranslation'] = array(
            'lang' => $this->input->post('language'),
            'productDescription' => $this->input->post('productDescription'),
        );
        $data['pageID'] = $pageID;
        $update = $this->Products_model->updateProductBasicDate($data);
        $url = '/vendor_admin/products/product_edit/' . $pageID . '?alert=success&message=' . urlencode($this->lang->line('VENDOR_ADMIN_UPDATE_PRODUCT_ALERT_OPERATION_SUCCESS'));
        redirect($url);
    }

    public function upload_image(){
        $pageID        = $this->input->post('pageID');
        $imgPath       = FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/';
        $smallImgPath  = FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/small/';
        $thumbnailPath = FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/thumbnail/';
        $image = $this->Products_model->createProductImage($imgPath, $smallImgPath, $thumbnailPath, $pageID);
//        dmp($image);
        redirect('/vendor_admin/products/product_edit/' . $pageID . '?');
    }

    public function ajax_delete_product_image(){
        $pageID = $this->input->post('pageID');
        $imgName = $this->input->post('imgName');
        if(file_exists(FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/' . $imgName)) unlink ( FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/' . $imgName);
        if(file_exists(FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/small/' . $imgName)) unlink ( FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/small/' . $imgName);
        if(file_exists(FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/thumbnail/' . $imgName)) unlink ( FCPATH . PRODUCTS_IMAGES_PATH . $pageID . '/thumbnail/' . $imgName);
        $this->db->where( 'productMediaID', $this->input->post('productMediaID') );
        $this->db->delete('product_images');
    }

    public function ajax_sort_product_images(){
        $data = $this->input->post('data');
        foreach($data as $sort => $productMediaID){
            $this->db->where( 'productMediaID', $productMediaID );
            $this->db->set( 'sort', $sort );
            $this->db->update( 'product_images' );
//            print_r("\n" . $this->db->last_query());
        }
    }


//    public function createPageUri($str, $parentPageID){
//        $str = convertToUrlFriendly($str);
//        $str = urldecode($str);
//        $str = $this->Products_model->createProductUrl($str, $parentPageID);
//        return $str;
//    }


    public function ajax_update_product_translation(){
        $data = $this->input->post();
        $update = $this->Products_model->updateTranslation($data);
    }


    public function ajax_update_price(){
        $qs = "INSERT INTO product_price (`pageID`, `currency`, `price`) VALUES ('" . $this->input->post('pageID') . "', '" . $this->input->post('currency') . "', " . $this->input->post('price') . ") ON DUPLICATE KEY UPDATE `price` = " . $this->input->post('price') . ";";
        $do = $this->db->query($qs);
        echo $do;
    }


    public function ajax_product_toggle_state(){
        $this->db->set('state', $this->input->post('state'));
        $this->db->where('pageID', $this->input->post('pageID'));
        $this->db->update('page');
    }


    public function ajax_compute_price(){
        $data = $this->input->post();
        $price = $this->Products_model->computePriceByPreferredCurrency($data);
        echo $price;
    }


    public function ajax_product_update_stock_amount(){
        $this->db->set('stockAmount', $this->input->post('stockAmount'));
        $this->db->where('pageID', $this->input->post('pageID'));
        $this->db->update('product');
    }

    public function ajax_delete_product(){
        $this->Products_model->deleteProductDefinitively();
    }













































































}