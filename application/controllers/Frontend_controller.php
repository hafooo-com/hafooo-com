<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 'On');


class Frontend_controller extends CI_Controller {

    public $data = array();
    public $page;
    public $cart;
    public $user;
    public $currencyTable;


    public function __construct(){
        parent::__construct();
        $this->load->model('frontend/Frontend_model');
        $this->load->model('frontend/Products_model');
        $this->setSettings();
        $this->setLanguage();
        $this->setCurrency();
        $this->setCart();
        $this->setDictionary('common');
        $this->load->library('ion_auth');
        $this->lang->load(array('auth_lang', 'ion_auth_lang'), $this->lang->line('CI_LANGUAGE_NAME'));
        if($this->input->post('userName') && $this->input->post('password')){
            $remember = $this->input->post('remember') ? true : false;
            $this->ion_auth->login($this->input->post('userName'), $this->input->post('password'), $remember);
            if($this->ion_auth->logged_in() && $this->ion_auth->in_group(2)){
                redirect('/user_account');
            }
        }
        if($this->ion_auth->logged_in() && !$this->ion_auth->in_group(2)){ // if vendor is logged in
            $this->ion_auth->logout();
        }
        $this->user = $this->ion_auth->user();
        $this->setPageData();
    }


    public function setPageData(){
        $this->page = $this->Frontend_model->getPageByUrl( $this->uri->uri_string() );
        if($this->page){
            if(is_file(APPPATH . 'models/' . $this->page['modelFile'] . '.php')){
                $this->load->model($this->page['modelFile']);
                $this->page['frontendData'] = isset($this->page['pageID']) ? $this->{$this->page['modelName']}->getFrontendData($this->page['pageID']) : $this->{$this->page['modelName']}->getFrontendData($this->page['viewFile']);
                if(!isset($this->page['seoTexts'])) {
                    $this->page['seoTexts']  = $this->{$this->page['modelName']}->getSeoTexts($this->page['viewFile']);
                    $this->page['frontendData']  = $this->{$this->page['modelName']}->getFrontendData($this->page['viewFile']);
                }
            }
            $this->setDictionary($this->page['viewFile']);
            if(!isset($this->page['pageName'])){
                $this->page['pageName'] = $this->lang->line($this->page['pageType'] . '_PAGE_NAME');
            }
            $this->page['menu']['mega_menu'] = $this->Frontend_model->getMenuTree('MEGA_MENU');
            $this->page['menu']['footer'] = $this->Frontend_model->getMenuTree('FOOTER');
            $this->buildFrontendView( strtolower($this->page['viewFile']) );
        }
        else{
            if(substr( $this->uri->uri_string(), 0, 12 ) == 'vendor_admin'){
                redirect('/vendor_admin');
            }
            $this->page = array();
            $this->page['menu']['mega_menu'] = $this->Frontend_model->getMenuTree('MEGA_MENU');
            $this->page['menu']['footer'] = $this->Frontend_model->getMenuTree('FOOTER');
        }
//        dmp( $this->page );
        return $this->page;
    }


    public function buildFrontendView($view){
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/' . $view, $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function setSettings() {
        $settings = $this->Frontend_model->getSettings();
        foreach ($settings as $key => $value) {
            define($value->constantName, $value->constantValue);
        }
        $this->config->config["site_title"] = SITE_NAME;
        $this->config->config["admin_email"] = ADMIN_EMAIL;
        $this->config->config["identity"] = ION_AUTH_IDENTITY;
        date_default_timezone_set (DATE_DEFAULT_TIMEZONE );
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
        define('ACTIVE_LANGUAGES', $this->Frontend_model->getActiveLanguages());
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
//        $getCurrency = $this->db->query("SELECT * FROM currency WHERE currencyCode = '". CURRENCY ."'")->result_array();
        $getCurrency = $this->db->query("SELECT * FROM currency WHERE allowed = 'Y' ORDER BY sort")->result_array();
        foreach($getCurrency as $currency){
            define('CURRENCY_NAME_ENGLIH' . strtoupper($currency['currencyCode']), $currency['currencyNameEnglish']);
            define('CURRENCY_NAME_NATIVE' . strtoupper($currency['currencyCode']), $currency['currencyNameNative']);
            $this->currencyTable[$currency['currencyCode']] = $currency;
        }
    }


    public function setDictionary($view = false){
        $dictionary = $this->Frontend_model->getDictionary($view, LANGUAGE, DEFAULT_LANGUAGE);
        foreach ($dictionary as $key => $value) {
            $this->lang->language[$value['phraseKey']] = $value['phraseValue'];
        }
    }


    public function setCart(){
        $this->load->library('My_cart');
        $this->cart = $this->my_cart->getCart();
    }





    public function controllerExists(){
        return file_exists( APPPATH . 'controllers/' . ucfirst($this->uri->segment(1)) . '.php' );
    }
}