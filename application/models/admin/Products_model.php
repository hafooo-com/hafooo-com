<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Products_model extends CI_Model
{


    public function __construct(){

    }


    public function getProducts(){
        $qs = "SELECT *
                FROM page p
                JOIN product pr ON pr.pageID = p.pageID
                ORDER BY p.created "    ;
    }


}