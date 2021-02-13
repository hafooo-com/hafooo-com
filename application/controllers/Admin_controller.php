<?php
defined('BASEPATH') or exit('No direct script access allowed');


error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Admin_controller extends CI_Controller
{

    public $cart;


    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->load->helper('my_admin_helper');
        $this->setSettings();
        $this->setLanguage();
        $this->setCurrency();
        $this->setCart();
        $this->load->library('ion_auth');
        $this->setDictionary('admin/common');
        $this->setDictionary('admin/admin');
        $this->lang->load(array('auth_lang', 'ion_auth_lang'), $this->lang->line('CI_LANGUAGE_NAME'));

        if($this->input->post('userName') && $this->input->post('password')){
            $remember = $this->input->post('remember') ? true : false;
            $this->ion_auth->login($this->input->post('userName'), $this->input->post('password'), $remember);
            if($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)){
                redirect('/admin');
            }
        }
        if($this->ion_auth->logged_in() && !$this->ion_auth->in_group(1)){ // if admin is logged in
            $this->ion_auth->logout();
        }
        $this->user = $this->ion_auth->user();
    }


    public function index(){
//        $this->load->view('admin/_header');
//        $this->load->view('admin/_footer');
    }


    public function admin_home(){
        redirect('/admin/dashboard');
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
        define('ACTIVE_LANGUAGES', $this->Admin_model->getActiveLanguages());
    }


    public function setSettings() {
        $settings = $this->Admin_model->getSettings();
        foreach ($settings as $key => $value) {
            define($value->constantName, $value->constantValue);
        }

        $this->config->config["site_title"] = SITE_NAME;
        $this->config->config["admin_email"] = ADMIN_EMAIL;
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
        $dictionary = $this->Admin_model->getDictionary($view, LANGUAGE, DEFAULT_LANGUAGE);
        foreach ($dictionary as $key => $value) {
            $this->lang->language[$value['phraseKey']] = $value['phraseValue'];
        }
    }
}