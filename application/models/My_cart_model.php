<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class My_cart_model  extends CI_Model  {


    public function __construct(){
        parent::__construct();
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

        foreach($cart['item'] as $key => $cartItem){
            $qs = "SELECT p.pageID, p.pageUri, p.imgSrc, pr.mainImage,
                        (SELECT pageName FROM page_translation WHERE pageID = '". $cart['item'][$key]['pageID'] ."' AND lang = '". LANGUAGE ."') AS pageName_LANGUAGE,
                        (SELECT pageName FROM page_translation WHERE pageID = '". $cart['item'][$key]['pageID'] ."' AND lang = '". DEFAULT_LANGUAGE ."') AS pageName_DEFAULT_LANGUAGE
                        FROM page p
                        LEFT JOIN product pr ON pr.pageID = p.pageID
                        LEFT JOIN product_price pp ON pp.pageID = p.pageID
                        WHERE p.pageID = '". $cart['item'][$key]['pageID'] ."'";
            $cartItemTexts = $this->db->query($qs)->result_array();

            $qs = "SELECT currency, price FROM product_price WHERE pageID = '". $cart['item'][$key]['pageID'] ."'";
            $prices = $this->db->query($qs)->result_array();
            $price = $this->convertPriceCurrency($prices);

            if(!empty($cartItemTexts)) {
                if(empty($cart['item'][$key]['mainImage']) || !is_file($cart['item'][$key]['mainImage'])){
                    $cart['item'][$key]['mainImage'] = DEFAULT_PRODUCT_IMAGE_PATH;
                }
                $cart['item'][$key]['pageUri'] = $cartItemTexts[0]['pageUri'];
                $cart['item'][$key]['imgSrc'] = $cartItemTexts[0]['imgSrc'];
                $cart['item'][$key]['pageName'] = pl($cartItemTexts[0]['pageName_LANGUAGE'], $cartItemTexts[0]['pageName_DEFAULT_LANGUAGE']);
                $cart['item'][$key]['price'] = $price;
            }
        }
        return $cart;
    }

    public function convertPriceCurrency($array){
        $prices = array();
        foreach($array as $key => $val){
            $prices[$val['currency']] = $val['price'];
        }

        if(array_key_exists(CURRENCY, $prices)){
            return $prices[CURRENCY];
        }
        else{
            $exchangeRates = json_decode(CURRENCY_EXCHANGE_RATES, true);
            return $prices[DEFAULT_CURRENCY] * $exchangeRates[CURRENCY];
        }
    }


}