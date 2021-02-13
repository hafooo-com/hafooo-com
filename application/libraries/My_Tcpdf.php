<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries//TCPDF/tcpdf.php';

class My_Tcpdf extends TCPDF
{

    public function __construct()
    {
        parent::__construct();
    }
}