<?php
defined('BASEPATH') or exit('No direct script access allowed');


error_reporting(E_ALL);
ini_set('display_errors', 1);

class Vendor_controller extends CI_Controller
{

    public $data = array();

    public function __construct(){
        parent::__construct();
        $this->load->model('vendor_admin/Vendor_model');
        $this->load->helper('my_admin_helper');
        $this->setSettings();
        $this->setLanguage();
        $this->setCurrency();
        $this->setCart();
        $this->load->library('ion_auth');
        $this->setDictionary('vendor/common');
        $this->setDictionary('vendor/admin');
        $this->lang->load(array('auth_lang', 'ion_auth_lang'), $this->lang->line('CI_LANGUAGE_NAME'));
        $this->data['allCurrencies'] = $this->db->query("SELECT * FROM currency WHERE allowed = 'Y' ORDER BY sort")->result_array();

//        dmp( $this->ion_auth->logged_in() ); die();
        if($this->input->post('userName') && $this->input->post('password')){
            $remember = $this->input->post('remember') ? true : false;
            $this->ion_auth->login($this->input->post('userName'), $this->input->post('password'), $remember);
            if($this->ion_auth->logged_in() && $this->ion_auth->in_group(3)){
                redirect('/vendor_admin/dashboard');
            }
        }
        if($this->ion_auth->logged_in() && !$this->ion_auth->in_group(3)){ // if vendor is logged in
            $this->ion_auth->logout();
        }
        if($this->ion_auth->logged_in()){
//            $this->user = $this->ion_auth->user()->row();
            $this->data['vendor'] = $this->Vendor_model->getVendorByUserID();
            if( $this->uri->uri_string() == 'vendor_admin' ){
                redirect('/vendor_admin/dashboard');
            }
        }
        else{
            if( $this->uri->uri_string() != 'vendor_admin/login' ){
                redirect('/vendor_admin/login');
            }
        }

    }


    public function index(){
//        $this->load->view('vendor_admin/_header');
//        $this->load->view('vendor_admin/_footer');
    }

//    public function login(){
//        dmp(22);
////        $this->load->view('vendor_admin/_header');
////        $this->load->view('vendor_admin/_footer');
//    }


    public function vendor_home(){
        redirect('/vendor_admin/dashboard');
    }


    public function setLanguage() {
        if($this->input->get('language')){
            setcookie('language', $this->input->get('language'), time()+2592000, '/');
            define('LANGUAGE', $this->input->get('language'));
        }
        else{
            if(!isset($_COOKIE['language'])){
                setcookie('language', DEFAULT_LANGUAGE, (time()+2592000), '/');
                define('LANGUAGE', DEFAULT_LANGUAGE);
            }
            else{
                define('LANGUAGE', $_COOKIE['language']);
            }
        }
        define('ACTIVE_LANGUAGES', $this->Vendor_model->getActiveLanguages());
    }


    public function setSettings() {
        $settings = $this->Vendor_model->getSettings();
        foreach ($settings as $key => $value) {
            define($value->constantName, $value->constantValue);
        }

        $this->config->config["site_title"] = SITE_NAME;
        $this->config->config["vendor_email"] = ADMIN_EMAIL;
        $this->config->config["identity"] = ION_AUTH_IDENTITY;

        date_default_timezone_set (DATE_DEFAULT_TIMEZONE );
    }


    public function setCurrency() {
        if($this->input->get('currency')){
            setcookie('currency', $this->input->get('currency'), time()+2592000, '/');
            define('CURRENCY', $this->input->get('currency'));
        }
        else{
            if(!isset($_COOKIE['currency'])){
                setcookie('currency', DEFAULT_CURRENCY, time()+2592000, '/');
                define('CURRENCY', DEFAULT_CURRENCY);
            }
            else{
                define('CURRENCY', $_COOKIE['currency']);
            }
        }
        $getCurrency = $this->db->query("SELECT * FROM currency WHERE currencyCode = '". CURRENCY ."'")->result_array();
        foreach($getCurrency as $currency){
            define('CURRENCY_NAME_ENGLIH', $currency['currencyNameEnglish']);
            define('CURRENCY_NAME_NATIVE', $currency['currencyNameNative']);
            $this->currencyTable[$currency['currencyCode']] = $currency;
        }
    }


    public function setCart(){
        $this->load->library('My_cart');
        $this->cart = $this->my_cart->getCart();
    }


    public function setDictionary($view = false){
        $dictionary = $this->Vendor_model->getDictionary($view, LANGUAGE, DEFAULT_LANGUAGE);
        foreach ($dictionary as $key => $value) {
            $this->lang->language[$value['phraseKey']] = $value['phraseValue'];
        }
    }
}