<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct(){
        parent::__construct();
    }


    public function index(){
        dmp('index');
    }


    public function recalculate(){
        dmp('recalculate');
    }

}