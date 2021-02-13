<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Administrators_model extends CI_Model
{

    public $data = array();

    public function __construct(){

    }


    public function getAdminData($pageID){
        $this->data['vendorProfile'] = $this->getVendorProfile($pageID);
    }


    public function getVendorProfile($pageID){
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


    public function getCart(){
        $userID = 0;
        $session = $this->input->cookie( CART_COOKIE_NAME );
        if(!$session){
            setcookie(CART_COOKIE_NAME, md5(microtime()), time() + 3600, '/');
        }
        else{
            setcookie(CART_COOKIE_NAME, $session, time() + 3600, '/');
        }

        $qs = "SELECT * FROM cart WHERE cookieID = '". $session ."'";
        $result = $this->db->query($qs)->result_array();
        if(empty($result)) {
            $qs = "INSERT INTO cart (cookieID, userID) VALUES ('". $session ."', '". $userID ."')";
            $result = $this->db->query($qs);
            $qs = "SELECT * FROM cart WHERE cookieID = '". $session ."'";
            $result = $this->db->query($qs)->result_array();
        }

        $cart = $result[0];
        $qs = "SELECT * FROM cart_item WHERE cartID = '". $cart['cartID'] ."'";
        $cart['item'] = $this->db->query($qs)->result_array();
        if(empty($cart['item'])) {
            return array();
        }

        foreach($cart['item'] as $cartItem){
            $qs = "SELECT p.pageUri, p.imgSrc, t.phraseValue AS pageName
                        FROM page p 
                        JOIN page_seo_translation t 
                        ON t.pageID = p.pageID
                        WHERE p.pageID = 2 
                        AND (t.phraseKey = 'PAGE_NAME' AND t.`language` = '". LANGUAGE ."')
                        OR (t.phraseKey = 'PAGE_NAME' AND t.`language` = '". DEFAULT_LANGUAGE ."')
                        ORDER BY FIELD(`language`, '". LANGUAGE ."', '". DEFAULT_LANGUAGE ."')";
            dmp($qs);
            $cartItemTexts = $this->db->query($qs)->result_array();
            if(!empty($cartItemTexts)){
                $cart['item']['pageUri'] = $cartItemTexts[0]['pageUri'];
                $cart['item']['imgSrc'] = $cartItemTexts[0]['imgSrc'];
                if(count($cartItemTexts) == 2){
                    $cart['item']['pageName'][LANGUAGE] = $cartItemTexts[0]['pageName'];
                    $cart['item']['pageName'][DEFAULT_LANGUAGE] = $cartItemTexts[1]['pageName'];
                }
                else{
                    $cart['item']['pageName'][LANGUAGE] = $cartItemTexts[0]['pageName'];
                    $cart['item']['pageName'][DEFAULT_LANGUAGE] = $cartItemTexts[0]['pageName'];
                }
            }
        }
        return $cart;
    }
}