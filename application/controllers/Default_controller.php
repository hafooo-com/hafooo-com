<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Frontend_controller.php';

class Default_controller extends Frontend_controller {

//'ARTICLE',
//'ARTICLES_CATEGORY',
//'BOOKMARKS',
//'CONTACT',
//'ERROR_404',
//'HOMEPAGE',
//'SEARCH',
//'SEARCH_RESULT',
//'SITEMAP',
//'USER_ACCOUNT',
//'USER_PROFILE',
//'USER_REGISTRATION',
//'USER_ACCOUNT',
//'USER_PROFILE',
//'USER_REGISTRATION',
//''

    public function __construct(){
        parent::__construct();
        $this->load->model('frontend/Default_model');
    }


    public function index(){

    }






}