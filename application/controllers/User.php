<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'Frontend_controller.php';

class User extends Frontend_controller
{



    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('frontend/User_model');
        $this->page['metaIndex'] = 'noindex';
        $this->page['metaFollow'] = 'nofollow';
    }


    public function index(){
//        $this->load->view('theme/'. CURRENT_THEME .'/_header');
//        $this->load->view('theme/'. CURRENT_THEME .'/_footer');
    }




    public function registration(){
        $this->setDictionary('user/registration');
        $this->page['viewFile'] = 'user/registration';
        $this->page['seoTexts'] = $this->User_model->getSeoTexts('user/registration');
        if($this->input->post('user-registration') === ''){
//            $_POST['phone'] = str_replace(' ', '', $this->input->post('phone'));
//            if(substr(0,2, $this->input->post('phone')) == '00'){
//                $count = 1;
//                $_POST['phone'] = str_replace('00', '+', $this->input->post('phone'), $count);
//            }
//            $this->form_validation->set_rules('first_name', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_FIRST_NAME'), 'required|min_length[2]|max_length[35]');
//            $this->form_validation->set_rules('last_name', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_LAST_NAME'), 'required|min_length[2]|max_length[35]');
//            $this->form_validation->set_rules('phone', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PHONE'), 'required|regex_match[/\+[0-9- ]{9,18}/]');
            $this->form_validation->set_rules('email', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_EMAIL'), 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD'), 'required');
            $this->form_validation->set_rules('password_again', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'), 'required|matches[password]');
            $this->form_validation->set_rules('terms_and_conditions', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_TERMS'), 'required');
            $this->form_validation->set_rules('privacy_policy', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'), 'required');
            $validation = $this->form_validation->run();
//            echo $validation;


            if($validation == false){
                echo validation_errors();
//                redirect('/user/registration');
//                $this->page['alert'] = array(
//
//                );
//                $this->page['seoTexts'] = $this->User_model->getSeoTexts('user/registration');
            }
            else{
                $this->config->load('email');
                $this->load->library('email');
                $configEmail = $this->config->item('emailConfig');

                $configEmail['smtp_host'] = SMTP_HOST;
                $configEmail['smtp_user'] = SMTP_USER;
                $configEmail['smtp_pass'] = SMTP_PASS;
                $configEmail['smtp_port'] = SMTP_PORT;

                $group = array('2'); // 2 = customer
                $activationCode = substr(convertToUrlFriendly(base64_encode(random_bytes(64)), true), 0, 64);

                $additional_data = array(
                    'phone' => $this->input->post('phone'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'activation_code' => $activationCode,
                );

                $this->setDictionary('email/user_registration_finished');
                $this->setDictionary('user/registration_finished');
                $userID = $this->ion_auth->register($this->input->post('email'), $this->input->post('password'), $this->input->post('email'), $additional_data, $group);

                $additional_data['userID'] = $userID;
                $this->sendActivationEmail($additional_data);
//                dmp(55);die;
                redirect('/user/registration_finished/' . $userID);
            }
        }
        else{
            $this->page['frontendData'] = $this->User_model->getFrontendData('user/registration');
            $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
            $this->load->view('theme/'. CURRENT_THEME .'/user/registration', $this->page);
            $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
        }
    }


    public function registration_finished(){
        $this->setDictionary('user/registration_finished');
        $user = $this->ion_auth->user( $this->uri->segment(3) )->row_array();
//        dmp($user);
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user/registration_finished', $user);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }

    /*
     * activate user account
     */
    public function activate(){
        $userID = $this->uri->segment(3);
        dmp($userID);
        $activation_code = $this->uri->segment(4);
        $activate = $this->User_model->activateUser($userID, $activation_code);
        redirect('/user/login');
    }


    public function sendActivationEmail($emailData){
        $this->setDictionary('vendor/registration_finished');
        $this->load->library('email');
        $this->config->load('email');
        $to = $this->input->post('email') ;
        $configEmail = $this->config->item('emailConfig');

        $configEmail['smtp_host'] = SMTP_HOST;
        $configEmail['smtp_user'] = SMTP_USER;
        $configEmail['smtp_pass'] = SMTP_PASS;
        $configEmail['smtp_port'] = SMTP_PORT;

        $message  = $this->load->view('theme/'. CURRENT_THEME .'/email/_email_header', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/user_registration_finished', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/_email_footer', $emailData,true);


        $this->email->initialize($configEmail);
        $this->email->clear();
        $this->email->to( $to );
        $this->email->from(SMTP_USER, SITE_NAME);
        $this->email->subject($this->lang->line('USER_REGISTRATION_FINISHED_SUCCESSFULLY_EMAIL_SUBJECT'));
        $this->email->message($message);
        $send = $this->email->send();
        return $send;
    }


    public function registration_was_successful(){

    }


    public function profile(){

    }



    public function forgotten_login_details(){
//        dmp($this->page);
    }

    public function login(){
        $this->setDictionary('user/login');
        $this->page['viewFile'] = 'user/login';
        $this->page['seoTexts'] = array(
            'pageName' => $this->lang->line('USER_LOGIN_PAGE_NAME'),
            'metaTitle' => $this->lang->line('USER_LOGIN_PAGE_NAME'),
            'metaDescription' => $this->lang->line('USER_LOGIN_PAGE_NAME'),
            'pageAnnotation' => '',
        );
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/user/login', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function logout(){
        $this->ion_auth->logout();
        redirect('/');
    }


    public function forgotten_password(){
        $this->page['frontendData']['js'] = array(
            '/theme/'. CURRENT_THEME .'/js/validator.min.js'
        );
        $this->page['viewFile'] = 'user/forgotten_password';
        $this->page['seoTexts'] = array(
            'pageName' => $this->lang->line('USER_FORGOTTEN_PASSWORD_PAGE_NAME'),
            'metaTitle' => $this->lang->line('USER_FORGOTTEN_PASSWORD_PAGE_NAME'),
            'metaDescription' => $this->lang->line('USER_FORGOTTEN_PASSWORD_PAGE_NAME'),
            'pageAnnotation' => '',
        );
        $this->setDictionary('user/forgotten_password');
        if($this->input->post('email')){
            $emailData['forgotten_password_selector'] = $this->User_model->getForgottenPasswordCode($this->input->post('email'));
            if(!$emailData['forgotten_password_selector']){
                redirect('/user/forgotten_password?email=false');
            }
            else{
                $sendLink = $this->sendLinkForNewPassword($emailData);
                redirect('/user/forgotten_password_finished/' . $emailData['forgotten_password_selector']);
            }
        }
        else{
            $this->page['viewFile'] = 'user/forgotten_password_form';
            $this->page['seoTexts'] = array(
                'pageName' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
                'metaTitle' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
                'metaDescription' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
                'pageAnnotation' => '',
            );
            $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
            $this->load->view('theme/'. CURRENT_THEME .'/forgotten_password_form', $this->page);
            $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
        }
    }


    public function sendLinkForNewPassword($emailData){
        $this->setDictionary('user/forgotten_password');
        $this->load->library('email');
        $this->config->load('email');
        $configEmail = $this->config->item('emailConfig');

        $configEmail['smtp_host'] = SMTP_HOST;
        $configEmail['smtp_user'] = SMTP_USER;
        $configEmail['smtp_pass'] = SMTP_PASS;
        $configEmail['smtp_port'] = SMTP_PORT;

        $message  = $this->load->view('theme/'. CURRENT_THEME .'/email/_email_header', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/forgotten_password_reset', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/_email_footer', $emailData,true);

        $this->email->initialize($configEmail);
        $to = $this->input->post('email') ;
        $this->email->clear();
        $this->email->to( $to );
        $this->email->from(SMTP_USER, SITE_NAME);
        $this->email->subject($this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_EMAIL_SUBJECT'));
        $this->email->message($message);
        $send = $this->email->send();
    }

    public function forgotten_password_finished(){
        $this->setDictionary('user/forgotten_password');
        $forgotten_password_selector = $this->uri->segment(3);
        $this->page['userData'] = $this->User_model->getUserByForgottenPasswordSelector($forgotten_password_selector);

        $this->User_model->getUserByEmail('');
        $this->page['viewFile'] = 'user/forgotten_password_finished';
        $this->page['seoTexts'] = array(
            'pageName' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
            'metaTitle' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
            'metaDescription' => $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'),
            'pageAnnotation' => '',
        );

        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/forgotten_password_finished', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }

    public function password_reset(){
        $this->page['forgotten_password_selector'] = $this->uri->segment(3);
        $this->page['frontendData'] = $this->User_model->getFrontendData('user/registration');
        $this->setDictionary('user/forgotten_password');
        $this->page['viewFile'] = 'user/forgotten_password';
        $this->page['seoTexts'] = array(
            'pageName' => $this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_PAGE_NAME'),
            'metaTitle' => $this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_PAGE_NAME'),
            'metaDescription' => $this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_PAGE_NAME'),
            'pageAnnotation' => '',
        );
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/forgotten_password_reset', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }

    public function forgotten_password_reset(){
        $forgotten_password_selector = $this->input->post('id');
        $user = $this->User_model->resetPassword($forgotten_password_selector);
//        dmp($user);die;
        if($user->group_id == '1'){
            redirect('/admin/login');
        }
        if($user->group_id == '2'){
            $this->ion_auth->login($user->email, $user->password);
//            dmp($user);
            redirect('/user_account');
        }
        if($user->group_id == '3'){
            redirect('/vendor_admin/login');
        }
    }




































}