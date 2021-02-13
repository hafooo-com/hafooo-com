<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Vendor_model extends CI_Model
{


    public function getFrontendData(){
        return array();
    }
    public function getSeoTexts(){
        return array();
    }





    public function getUserData($userID){
//        $this->db->select('activation_code, email');
        $this->db->where('id', $userID);
        $userData = $this->db->get('users')->result_array();
        if(!empty($userData)){
            return $userData[0];
        }
        else{
            return false;
        }
    }



    public function activateVendor($userID, $activation_code){
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

}