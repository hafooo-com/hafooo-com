<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Vendor_model extends CI_Model
{


    public function __construct(){

    }


    public function getSettings(){
        $this->db->select('*');
        $result = $this->db->get('settings')->result();
        if(!$result)
            return array();
        else
            return $result;
    }


    public function getActiveLanguages(){
        $queryString = "SELECT * FROM languages WHERE state = 'ACTIVE' ORDER BY sort, languageNameNative";
        $result = $this->db->query($queryString)->result_array();
        $langs = array();
        foreach($result as $lang){
            $langs[$lang['languageCode']] = $lang;
        }
        unset($result);
        return $langs;
    }


    public function getVendorByUserID(){
        $row = $this->db->query("SELECT * FROM vendor v JOIN vendor_user u ON u.vendorID = v.vendorID WHERE u.userID = '6'")->row_array();
        return $row;
    }


    public function getDictionary($view, $language, $default_language ){
        $queryString = "SELECT phraseKey, " . $language . " FROM dictionary WHERE  appView IN('common','". $view ."')";
        $result[$language] = $this->db->query($queryString)->result_array();
        $queryString = "SELECT phraseKey, " . $default_language . " FROM dictionary WHERE  appView IN('common','". $view ."')";
        $result[$default_language] = $this->db->query($queryString)->result_array();

        $phrases = array();
        foreach($result[$language] as $key => $phrase){
            $phrases[$key]['phraseKey'] = $phrase['phraseKey'];
            $phrases[$key]['phraseValue'] = pl( $result[$language][$key][$language], $result[$default_language][$key][$default_language] );
        }
        return $phrases;
    }


}