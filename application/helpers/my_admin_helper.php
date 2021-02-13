<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function menuOpen($menuUrl , $url = false){
    if(strpos(trim($url, '/'), trim($menuUrl, '/')) !== false){
        return ' menu-open';
    }
    else{
        return '';
    }
}

function activeLink($menuUrl = array() , $url = false){
    if(strpos(trim($url, '/'), trim($menuUrl, '/')) !== false){
        return ' active';
    }
    else{
        return '';
    }
}