<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Frontend_model extends CI_Model
{


    public function __construct(){

    }


    public function getMenuTree($menu, $parentItemID = 0){
        $qs = "SELECT menuItemID, title, uri FROM menu WHERE menu = '" . $menu . "' AND lang = '" . LANGUAGE . "' AND parentItemID = '" . $parentItemID . "' ORDER BY sort";
        $result = $this->db->query($qs)->result_array();
        foreach($result as $key => $menuItem){
            $result[$key]['subs'] = $this->getMenuTree($menu, $menuItem['menuItemID']);
        }
        return $result;
    }


    public function getSettings( ){
        $this->db->select('*');
        $result = $this->db->get('settings')->result();
        if(!$result)
            return array();
        else
            return $result;
    }


    public function getActiveLanguages(){
        $queryString = "SELECT * FROM languages WHERE state = 'ACTIVE' ORDER BY sort, languageNameNative";
        $result = $this->db->query($queryString)->result_array();
        $langs = array();
        foreach($result as $lang){
            $langs[$lang['languageCode']] = $lang;
        }
        unset($result);
        return $langs;
    }


    public function getDictionary($view, $language, $default_language ){
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




    public function getView($object, $method_name){
        if(method_exists($object, $method_name)){
            return strtolower($object . '/' . $method_name);
        }
        else{
            return $object;
        }
    }


    public function getPageLanguage(){
        $this->db->where('lang', LANGUAGE);
        $this->db->select('*');
        $result = $this->db->get('dictionary')->result();
        if(!$result)
            return array();
        else
            return $result;
    }


    public function processSeoText($result, $field){
        if(!isset($result[LANGUAGE][0][$field]) || empty($result[LANGUAGE][0][$field] || !is_string($result[LANGUAGE][0][$field]))){
            if(!isset($result[DEFAULT_LANGUAGE][0][$field]) || empty($result[DEFAULT_LANGUAGE][0][$field] || !is_string($result[DEFAULT_LANGUAGE][0][$field]))){
                $value = SITE_NAME;
            }
            else{
                $value = $result[DEFAULT_LANGUAGE][0][$field];
            }
        }
        else{
            $value = $result[LANGUAGE][0][$field];
        }
        return $value;
    }


    public function getSeoTexts($pageID){
        $qs = "SELECT pageName, metaTitle, metaDescription, metaKeywords, pageAnnotation FROM page_translation 
                    WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."' ORDER BY lang";
        $result[DEFAULT_LANGUAGE] = $this->db->query($qs)->result_array();
        $qs = "SELECT pageName, metaTitle, metaDescription, metaKeywords, pageAnnotation FROM page_translation 
                    WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."' ORDER BY lang";
        $result[LANGUAGE] = $this->db->query($qs)->result_array();

        $seoTexts = array();
        $seoTexts['pageName'] = $this->processSeoText($result, 'pageName');
        $seoTexts['metaTitle'] = $this->processSeoText($result, 'metaTitle');
        $seoTexts['metaDescription'] = $this->processSeoText($result, 'metaDescription');
        $seoTexts['metaKeywords'] = $this->processSeoText($result, 'metaKeywords');
        $seoTexts['pageAnnotation'] = $this->processSeoText($result, 'pageAnnotation');
        return $seoTexts;
    }


    public function getPageByUrl($url){
        $this->db->where('pageUri', $url);
        $this->db->select('*');
        $result = $this->db->get('page')->result_array();
        if(!empty($result)) {
            $page = $result[0];
            $page['modelName'] = ucfirst(strtolower( $page['pageType'] )) . '_model';
            $page['modelFile'] = 'frontend/' . ucfirst(strtolower( $page['pageType'] )) . '_model';
            $page['viewFile'] = strtolower( $page['pageType'] );
            $page['seoTexts']  = $this->getSeoTexts($page['pageID']);
            return $page;
        }
        else{
            return false;
//            $str = trim($this->uri->segment(1) . '/' . $this->uri->segment(2), '_/'); //  if there is not 2nd segment, remove the _
//            $pageType = strtoupper( str_replace('/', '_', $str) );
//            $page = array(
//                'pageType'  => $pageType,
//                'modelName' => ucfirst(strtolower( $pageType )) . '_model',
//                'modelFile' => 'frontend/' . ucfirst(strtolower( $pageType )) . '_model',
//                'viewFile'  => $str,
//                'pageID' => 0,
//                'metaIndex' => 'noindex',
//                'metaIndex' => 'metaFollow',
//            );
        }
    }


}