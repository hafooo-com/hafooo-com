<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends CI_Model
{

    public $data = array();


    public function __construct()
    {

    }

    public function getFrontendData( $viewFile ){
//        dmp($viewFile);
        $this->data['css'] = array();
        $this->data['js']  = array('/theme/'. CURRENT_THEME .'/js/validator.min.js');
        return $this->data;
    }


    public function getAdminData(){
        return false;
    }


    public function getUserByEmail($email){
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();
        return $user;
    }

    public function getUserByForgottenPasswordSelector($selector){
        $this->db->where('forgotten_password_selector', $selector);
        $user = $this->db->get('users')->row();
        return $user;
    }


    public function getForgottenPasswordCode($email){
        $this->load->model('Ion_auth_model');
        $code = $this->Ion_auth_model->forgotten_password($email);
        if(!$code){
            return false;
        }
        $userData = $this->db->query("SELECT * FROM users WHERE email = '". $email ."'")->result();
        if(!empty($userData)){
//            $data = array(
//                'forgotten_password_code' => sha1(microtime() . $email),
//                'forgotten_password_selector' => sha1(microtime() . $email),
//            );
            return  $userData[0]->forgotten_password_selector . '.' . sha1($userData[0]->email );
        }
        return false;
    }


    public function activateUser($userID, $activation_code){
        $this->db->select('activation_code, email');
        $this->db->where('id', $userID);
        $userData = $this->db->get('users')->result_array();
        if(!empty($userData)){
            $this->db->query("UPDATE users SET active = '1' WHERE id = '". $userID . "'");
            return true;
        }
        else{
            return false;
        }
    }


    public function resetPassword($id){
        list($forgotten_password_selector, $emailSha1) = explode('.', $id);
        $qs = "SELECT u.id, ug.group_id 
                FROM users u
                JOIN users_groups_relation ug ON ug.user_id = u.id 
                WHERE sha1(u.email) = '$emailSha1' AND u.forgotten_password_selector = '$forgotten_password_selector'";

        $user = $this->db->query($qs)->result();
        if(!empty($user)){
            $passwordHashed = $this->ion_auth->hash_password($this->input->post('password'), $user[0]->email);
            $qs = "UPDATE users SET password = '$passwordHashed' WHERE sha1(email) = '$emailSha1' AND forgotten_password_selector = '$forgotten_password_selector'";
            $this->db->query($qs);
            $user[0]->password = $this->input->post('password');
            return $user[0];
        }
        return false;
    }


    public function getSeoTexts($view){
        $seoTexts = array();
        $seoTexts['pageAnnotation'] = false;

        switch($view){
            case 'xxxxx':
                $seoTexts['pageName'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
                $seoTexts['metaTitle'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
                $seoTexts['metaDescription'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
                break;
            default:
                $seoTexts['pageName'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
                $seoTexts['metaTitle'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
                $seoTexts['metaDescription'] = $this->lang->line(strtoupper( str_replace('/', '_', $view) ) . '_PAGE_NAME');
        }
//            USER_REGISTRATION
//        $qs = "SELECT en, sk FROM dictionary WHERE appView = '". $view ."' AND phraseKey = ''";

        return $seoTexts;
    }

}