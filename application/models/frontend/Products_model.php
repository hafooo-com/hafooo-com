<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Products_model extends CI_Model
{


    public function __construct()
    {

    }


    public function getProductCategoriesTree($parentPageID = 1){
        $qs = "SELECT *
                FROM page p
                LEFT JOIN page_translation pt ON pt.pageID = p.pageID
                WHERE p.pageType = 'CATEGORY_PRODUCTS'
                AND p.parentPageID = '". $parentPageID ."'
                AND pt.lang = '". LANGUAGE ."'
                AND p.state = 'ACTIVE' ORDER BY p.sort";
        $categories = $this->db->query($qs)->result_array();
        foreach($categories as $key => $category){
            $categories[$key]['subCategories'] = $this->getProductCategoriesTree( $category['pageID'] );
        }
        return $categories;
    }



}