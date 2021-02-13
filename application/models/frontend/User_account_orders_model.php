<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_account_orders_model extends CI_Model
{


    public function __construct()
    {

    }


    public function getFrontendData()
    {
        $data['userAccountMenu'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/user_account_menu', $this->page, true);
        return $data;
    }


    public function getSeoTexts()
    {

    }



}
