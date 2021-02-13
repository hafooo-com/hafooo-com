<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_cart
{

    public $CI;
    public $totalPrice;
    public $totalItems;
    public $cartData = array();


    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('My_cart_model');
//        dmp($this->my_cart_model->getCart());

    }


    public function getItems(){
//        $this->My_cart_model->getItems();
    }


    public function getCart(){
        $this->cartData = $this->CI->My_cart_model->getCart();
        return $this->cartData;
    }


    public function getTotalPrice(){
        return $this->totalPrice;
    }


    public function getTotalItems(){
        return $this->totalItems;
    }


    public function addToCart(){

    }


    public function removeFromCart(){

    }

    public function computeDiscount(){

    }

}