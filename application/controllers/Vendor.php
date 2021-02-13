<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'Frontend_controller.php';


class Vendor extends Frontend_controller
{


    public function __construct(){
        parent::__construct();
        $this->load->model('frontend/Vendor_model');

    }


    public function index(){

    }

    public function registration(){
        $this->setDictionary('vendor/registration');
        if($this->input->post()){
            $_POST['phone'] = str_replace(' ', '', $this->input->post('phone'));
            if(substr(0,2,$this->input->post('phone')) == '00'){
                $count = 1;
                $_POST['phone'] = str_replace('00', '+', $this->input->post('phone'), $count);
            }
            $this->form_validation->set_rules('vendor_name', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_VENDOR_NAME'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('vendor_address_line_1', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_LINE_1'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('vendor_city', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_CITY'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('vendor_zip', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_ZIP'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('vendor_country', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_COUNTRY'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('vendor_state', $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_STATE'), 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('phone', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PHONE'), 'required|regex_match[/\+[0-9- ]{9,18}/]');
            $this->form_validation->set_rules('email', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_EMAIL'), 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD'), 'required');
            $this->form_validation->set_rules('password_again', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'), 'required|matches[password]');
            $this->form_validation->set_rules('terms_and_conditions', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_TERMS'), 'required');
            $this->form_validation->set_rules('privacy_policy', $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'), 'required');
            $validation = $this->form_validation->run();
            if($validation == false){
                echo validation_errors();
            }
            else{
                $this->config->load('email');
                $this->load->library('email');
                $configEmail = $this->config->item('emailConfig');

                $configEmail['smtp_host'] = SMTP_HOST;
                $configEmail['smtp_user'] = SMTP_USER;
                $configEmail['smtp_pass'] = SMTP_PASS;
                $configEmail['smtp_port'] = SMTP_PORT;

                $activationCode = substr(convertToUrlFriendly(base64_encode(random_bytes(64)), true), 0, 64);
                $vendorData = array(
                    'vendorName' => $this->input->post('vendor_name'),
                    'vendorPhone' => $this->input->post('phone'),
                    'vendorEmail' => $this->input->post('email'),
                    'addressLine_1' => $this->input->post('vendor_address_line_1'),
                    'addressLine_2' => $this->input->post('vendor_address_line_2'),
                    'city' => $this->input->post('vendor_city'),
                    'zip' => $this->input->post('vendor_zip'),
                    'country' => $this->input->post('vendor_country'),
                    'region' => $this->input->post('vendor_state'),
                );

                $additional_data = array(
                    'phone' => $this->input->post('phone'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'activation_code' => $activationCode,
                );
                $group = array('3'); // 3 = vendor

                $emailData = array(
                    'type' => 'registration',
                );

                $this->setDictionary('email/vendor_registration_finished');

                $userID = $this->ion_auth->register($this->input->post('email'), $this->input->post('password'), $this->input->post('email'), $additional_data, $group);
                $this->db->insert('vendor', $vendorData);
                $emailData = array_merge($vendorData, $additional_data);
                $emailData['userID'] = $userID;
                $emailData['activation_code'] = $activationCode;
                $this->sendActivationEmail($emailData);
                redirect('/vendor/registration_finished/' . $userID);

            }
        }
        else{
            /** show registration form */
            $this->page['seoTexts'] = array(
                'metaDescription' => '',
                'metaTitle' => SITE_NAME
            );
            $this->page['viewFile'] = 'vendor/registration';
//            $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
//            $this->load->view('theme/'. CURRENT_THEME .'/vendor/registration', $this->page);
//            $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
        }


    }


    public function registration_finished(){
        $userID = $this->uri->segment(3);
        if(!$userID){
            redirect('/vendor/registration');
        }

        $this->setDictionary('vendor/registration_finished');
        $this->page['userData'] = $this->Vendor_model->getUserData($userID);
        if(!$this->page['userData']){
            redirect('/vendor/registration');
        }
        if($this->page['userData']['active'] === '1'){
            redirect('/vendor/login');
        }
        $this->page['seoTexts'] = array(
            'metaDescription' => '',
            'metaTitle' => SITE_NAME
        );
        $this->page['viewFile'] = 'vendor/registration_successfully';
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/vendor/registration_successfully', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }


    public function activate(){
        $userID = $this->uri->segment(3);
        $activation_code = $this->uri->segment(4);
        $activate = $this->Vendor_model->activateVendor($userID, $activation_code);
        redirect('/vendor_admin/login');
    }


    public function sendActivationEmail($emailData){
        $this->setDictionary('vendor/registration');
        $this->setDictionary('vendor/registration_finished');
        $this->config->load('email');
        $this->load->library('email');
        $configEmail = $this->config->item('emailConfig');

        $configEmail['smtp_host'] = SMTP_HOST;
        $configEmail['smtp_user'] = SMTP_USER;
        $configEmail['smtp_pass'] = SMTP_PASS;
        $configEmail['smtp_port'] = SMTP_PORT;

        $message  = $this->load->view('theme/'. CURRENT_THEME .'/email/_email_header', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/vendor_registration_finished', $emailData,true);
        $message .= $this->load->view('theme/'. CURRENT_THEME .'/email/_email_footer', $emailData,true);

        $this->email->initialize($configEmail);
        $to = $this->input->post('email') ;
        $this->email->clear();
        $this->email->to( $to );
        $this->email->from(SMTP_USER, SITE_NAME);
        $this->email->subject($this->lang->line('VENDOR_REGISTRATION_FINISHED_SUCCESSFULLY_EMAIL_TEXT'));
        $this->email->message($message);
        $this->email->send();
    }



}