<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Vendor_detail_model extends CI_Model
{

    public $data = array();


    public function __construct()
    {

    }


    public function getFrontendData($pageID){
        $this->data['vendor'] = $this->getFrontendVendorDetail($pageID);//`
        $this->data['vendor']['products'] = $this->getVendorProducts($this->data['vendor']['vendorID']);
        $this->data['css'] = array();
        $this->data['js']  = array();
        return $this->data;
    }


    public function getAdminData(){
        return false;
    }


    public function getFrontendVendorDetail($pageID){
        $qs = "SELECT *  FROM vendor v JOIN page p ON p.pageID = v.pageID WHERE p.pageID = '". $pageID ."'";
        $pageData = $this->db->query($qs)->result_array();
        if(empty($pageData)){
            return false;
        }
        return $pageData[0];
    }


    public function getVendorProducts($vendorID){
        $qs = "SELECT * FROM product WHERE vendorID = '". $vendorID ."'";
        $products = $this->db->query($qs)->result_array();
        if(empty($products)){
            return $vendorID;
        }

        foreach($products as $key => $product){
            $qs = "SELECT currency, price FROM product_price 
                    WHERE pageID = '". $product['pageID'] ."' 
                    AND (currency = '". CURRENCY ."' OR currency = '". DEFAULT_CURRENCY ."') 
                    ORDER BY FIELD(currency, '". DEFAULT_CURRENCY ."') DESC";
            $price = $this->db->query($qs)->result_array();
            $products[$key]['price'] = isset($price[1]) ? $price[1]['price'] : $price[0]['price'];
            $products[$key]['priceString'] = priceFormat($products[$key]['price'], $price[0]['currency'] ) ;
        }
        return $products;
    }


}