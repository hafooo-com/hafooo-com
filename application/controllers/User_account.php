<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'Frontend_controller.php';

class User_account extends Frontend_controller
{



    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('/user/login');
        }
        $this->setDictionary('user/user_account');
        $this->load->library('form_validation');
        $this->load->model('frontend/User_model');
        $this->page['user'] = $this->ion_auth->user()->row();
        $this->page['metaIndex'] = 'noindex';
        $this->page['metaFollow'] = 'nofollow';
        $this->page['frontendData'] = array(
            'js' => array(
                '/theme/'. CURRENT_THEME .'/js/validator.min.js',
                '/theme/'. CURRENT_THEME .'/js/user/user_account.js',
            )
        );
    }


    public function index(){
        redirect('/user_account/profile');
//        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_USER_DETAILS_PAGE_NAME');
//        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
//        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
//        $this->load->view('theme/'. CURRENT_THEME .'/user_account', $this->page);
//        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function orders(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_ORDERS_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_account/orders', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function profile(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_USER_DETAILS_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_account/profile', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function address_book(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_ADDRESS_BOOK_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_address_book', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }

    public function password(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_CHANGE_PASSWORD_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_account/password', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function purchased_goods(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_PURCHASED_GOODS_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_purchased_goods', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function complaints(){
        $this->page['pageName'] = $this->lang->line('USER_ACCOUNT_COMPLAINTS_PAGE_NAME');
        $this->page['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user_complaints', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function update_password(){
        $this->form_validation->set_rules('password', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD'), 'required');
        $this->form_validation->set_rules('password_again', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'), 'required|matches[password]');
        $validation = $this->form_validation->run();
        if($validation == false){
            $validation_errors = validation_errors();
            $errorFields = array();
            if(strpos($validation_errors,'password') !== false) {$errorFields[] = 'first_name';}
            if(strpos($validation_errors,'password_again') !== false) {$errorFields[] = 'last_name';}

            $httpQuery = http_build_query( $this->input->post() );
            $errorFields = implode( '-', $errorFields );
            $url = '/user_account/password?alert=danger&message=' . urlencode($this->lang->line('USER_ACCOUNT_PASSWORD_UPDATE_FAILED')) . '&errorFields=' . $errorFields;
            redirect( $url );
        }
        $id = $this->input->post('id');
        $data = array(
            'password' => $this->input->post('password'),
        );
        $update = $this->ion_auth->update($id, $data);
        if($update === true){
            redirect('/user_account?alert=success&message=' . urlencode($this->lang->line('USER_ACCOUNT_PASSWORD_UPDATE_SUCCESS')));
        }
        else{
            redirect('/user_account?alert=danger&message=' . urlencode($this->lang->line('USER_ACCOUNT_PASSWORD_UPDATE_ERROR')));
        }
    }


    public function update_details(){
        $_POST['phone'] = str_replace(' ', '', $this->input->post('phone'));
        if(substr(0,2,$this->input->post('phone')) == '00'){
            $count = 1;
            $_POST['phone'] = str_replace('00', '+', $this->input->post('phone'), $count);
        }

        $this->form_validation->set_rules('first_name', 'first_name', 'required|min_length[2]|max_length[150]');
        $this->form_validation->set_rules('last_name',  'last_name',  'required|min_length[2]|max_length[150]');
        $this->form_validation->set_rules('phone',      'phone',      'required|regex_match[/\+[0-9- ]{9,18}/]');
        if($this->input->post('email') != $this->ion_auth->user()->row()->email){
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',
                array(
                    'valid_email'     => 'valid_email',
                    'is_unique'     => 'email_unique',
                )
            );
        }
        $this->form_validation->set_rules('privacy_policy_consent', 'privacy_policy_consent', 'required|regex_match[/Y{1,1}/]');
        $this->form_validation->set_rules('terms_consent', 'terms_consent', 'required|regex_match[/Y*/]');

        $validation = $this->form_validation->run();
        if($validation == false){
            $validation_errors = validation_errors();
            $errorFields = array();
            if(strpos($validation_errors,'first_name') !== false) {$errorFields[] = 'first_name';}
            if(strpos($validation_errors,'last_name') !== false) {$errorFields[] = 'last_name';}
            if(strpos($validation_errors,'phone') !== false) {$errorFields[] = 'phone';}
            if(strpos($validation_errors,'valid_email') !== false) {$errorFields[] = 'valid_email';}
            if(strpos($validation_errors,'email_unique') !== false) {$errorFields[] = 'email_unique';}
            if(strpos($validation_errors,'privacy_policy_consent') !== false) {$errorFields[] = 'privacy_policy_consent';}
            if(strpos($validation_errors,'terms_consent') !== false) {$errorFields[] = 'terms_consent';}
            $httpQuery = http_build_query( $this->input->post() );
            $errorFields = implode( '-', $errorFields );
            $url = '/user_account?alert=danger&message=' . urlencode($this->lang->line('USER_ACCOUNT_DETAILS_UPDATE_FAILED')) . '&errorFields=' . $errorFields . '&' . $httpQuery;
            redirect( $url );
        }
        $data = $this->input->post();
        $id = $this->input->post('id');

        $additional_data = array(
            'first_name' => 'Ben',
            'last_name' => 'Edmunds',
        );

        $update = $this->ion_auth->update($id, $data);
        if($update === true){
            redirect('/user_account?alert=success&message=' . urlencode($this->lang->line('USER_ACCOUNT_DETAILS_UPDATE_SUCCESS')));
        }
        else{
            redirect('/user_account?alert=danger&message=' . urlencode($this->lang->line('USER_ACCOUNT_DETAILS_UPDATE_ERROR')));
        }
    }












































}