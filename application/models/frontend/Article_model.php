<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Article_model extends CI_Model
{

    public $data = array();


    public function __construct()
    {

    }


    public function getFrontendData($pageID){
        $this->data['article'] = $this->getFrontendArticle($pageID);
        $this->data['css'] = array();
        $this->data['js']  = array();
        return $this->data;
    }


    public function getAdminData(){
        return false;
    }


    public function getFrontendArticle($pageID){
        $qs = "SELECT a.relatedArticles, a.galleryID, a.isNovelty, t.annotation, t.article, t.`lang`
                FROM article a
                LEFT JOIN article_translation t
                ON t.pageID = a.pageID
                WHERE t.`lang` = '". LANGUAGE ."'
                OR t.`lang` = '". DEFAULT_LANGUAGE ."'";
        $result = $this->db->query($qs)->result_array();

        if(empty($result)){
            return false;
        }

        $article = array();
        foreach($result as $text){
            $article[$text['lang']] ['annotation'] = $text['annotation'];
            $article[$text['lang']] ['article'] = $text['article'];
            $article['relatedArticles'] = $text['relatedArticles'];
            $article['galleryID'] = $text['galleryID'];
            $article['isNovelty'] = $text['isNovelty'];
        }
        return $article;
    }


}