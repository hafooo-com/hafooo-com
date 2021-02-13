<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Frontend_controller.php';

class Error_404 extends Frontend_controller
{

    public function __construct(){
        parent::__construct();
        $this->page = array(
            'metaIndex' => 'noindex',
            'metaFollow' => 'nofollow',
        );
        $this->setDictionary('error_404');
    }


    public function index(){

//        $this->page = array(
//            'seoTexts' => array(
//                'pageName' => 'qqq',
//            ),
//        );
        $this->load->view('theme/'. CURRENT_THEME .'/_header', $this->page);
        $this->load->view('theme/'. CURRENT_THEME .'/error_404');
        $this->load->view('theme/'. CURRENT_THEME .'/_footer', $this->page);
    }
}