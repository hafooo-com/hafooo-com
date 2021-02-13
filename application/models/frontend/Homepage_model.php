<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Homepage_model extends CI_Model
{

    public $data = array();


    public function __construct()
    {
    }

    public function getFrontendData(){
        $this->data['css'] = array();
        $this->data['js']  = array('/theme/'. CURRENT_THEME .'/assets/owl-carousel/owl.carousel.min.js');
        return $this->data;
    }

    public function getAdminData(){
        return false;
    }


}