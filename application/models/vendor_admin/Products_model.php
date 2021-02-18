<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Products_model extends CI_Model
{


    public function __construct(){

    }
//t1.pageName AS pageName_LANGUAGE, t1.metaTitle AS metaTitle_LANGUAGE, t1.metaDescription AS metaDescription_LANGUAGE, t1.pageAnnotation AS pageAnnotation_LANGUAGE,
//t2.pageName AS pageName_DEFAULT_DEFAULT_LANGUAGE, t2.metaTitle AS metaTitle_DEFAULT_LANGUAGE, t2.metaDescription AS metaDescription_DEFAULT_LANGUAGE,
//t2.pageAnnotation AS pageAnnotation_DEFAULT_LANGUAGE

    public function getProductCategoriesTree(){
        $qs = "SELECT * FROM page WHERE pageType = 'CATEGORY_PRODUCTS' AND parentPageID = (SELECT pageID FROM page WHERE pageType = 'HOMEPAGE') AND state = 'ACTIVE' ORDER BY sort";
        $categoriesFirstLvl = $this->db->query($qs)->result_array();
        foreach($categoriesFirstLvl as $key => $categoryFirstLvl){
            $pageID = $categoryFirstLvl['pageID'];
            $qs = "SELECT 
                    IFNULL((SELECT lang            FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT lang            FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS lang,
                    IFNULL((SELECT pageName        FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT pageName        FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS pageName,
                    IFNULL((SELECT metaTitle       FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT metaTitle       FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS metaTitle,
                    IFNULL((SELECT metaDescription FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT metaDescription FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS metaDescription,
                    IFNULL((SELECT pageAnnotation  FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT pageAnnotation  FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS pageAnnotation";
            $translation = $this->db->query($qs)->result_array();
            $categoriesFirstLvl[$key]['translation'] = empty($translation) ? array(DEFAULT_LANGUAGE, '', '', '', '') : $translation[0];
            $categoriesFirstLvl[$key]['subCategories'] = $this->getProductSubCategories( $pageID );
        }
        return $categoriesFirstLvl;
    }


    public function getProductSubCategories($parentPageID){
        $qs = "SELECT * FROM page WHERE pageType = 'CATEGORY_PRODUCTS' AND parentPageID = '". $parentPageID ."' AND state = 'ACTIVE' ORDER BY sort";
        $subcategories = $this->db->query($qs)->result_array();
        foreach($subcategories as $key => $subcategory){
            $pageID = $subcategory['pageID'];
            $qs = "SELECT 
                    IFNULL((SELECT lang            FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT lang            FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS lang,
                    IFNULL((SELECT pageName        FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT pageName        FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS pageName,
                    IFNULL((SELECT metaTitle       FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT metaTitle       FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS metaTitle,
                    IFNULL((SELECT metaDescription FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT metaDescription FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS metaDescription,
                    IFNULL((SELECT pageAnnotation  FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". LANGUAGE ."'),(SELECT pageAnnotation  FROM page_translation WHERE pageID = '". $pageID ."' AND lang = '". DEFAULT_LANGUAGE ."')) AS pageAnnotation";
            $translation = $this->db->query($qs)->result_array();
            $subcategories[$key]['translation'] = empty($translation) ? array(DEFAULT_LANGUAGE, '', '', '', '') : $translation[0];
            $subcategories[$key]['subCategories'] = $this->getProductSubCategories( $pageID );
        }
        return $subcategories;
    }



    public function createProduct($data){
        $this->db->insert('page', $data['page']);
        $pageID = $this->db->insert_id();
        $data['pageTranslation']['pageID'] = $data['product']['pageID'] = $data['productTranslation']['pageID'] = $pageID;

        $this->db->insert('page_translation', $data['pageTranslation']);
        $this->db->insert('product_translation', $data['productTranslation']);
        $this->db->insert('product', $data['product']);
        $this->db->set('defaultLanguageRelationPageID', $pageID);
        $this->db->where('pageID', $pageID);
        $this->db->update('page');

        $pageMediaPath = FCPATH . str_replace('_PAGE_ID_', $pageID, DEFAULT_PAGE_MEDIA_PATH);
        mkdir($pageMediaPath);

        return $pageID;
    }


    public function updateProductBasicDate( $data ){
        $update[] = $this->db->set($data['page'])->where('pageID', $data['pageID'])->update('page');
        $update[] = $this->db->set($data['product'])->where('pageID', $data['pageID'])->update('product');
        $update[] = $this->db->set($data['pageTranslation'])->where('pageID', $data['pageID'])->update('page_translation');
        $update[] = $this->db->set($data['productTranslation'])->where('pageID', $data['pageID'])->update('product_translation');
        return $update;
    }


    public function createProductUrl($str, $parentPageID){
        $str = convertToUrlFriendly($str, true);
        $i = 0;
        $urlFree = false;
        $qs = "SELECT pageUri FROM page WHERE pageID = '". $parentPageID ."'";
        $parentPageUri = $this->db->query($qs)->row('pageUri');
        $url = $parentPageUri .'/'. $str;

        $qs = "SELECT pageID FROM page WHERE pageUri = '". $url ."'";
        while(!$urlFree){
            $result = $this->db->query($qs)->result();
            if(empty($result)){
                return $url;
            }
            else{
                $i++;
                $str = $url . '-' . $i;
                $qs = "SELECT pageID FROM page WHERE pageUri = '". $str ."'";
                if ($i > 5) die;
            }
        }
        return $str;
    }


    public function getProductData($pageID){
        $this->db->where('pageID', $pageID);
        $data['page'] = $this->db->get('page')->row_array();

        $page_translation = $this->db->query("SELECT * FROM page_translation WHERE pageID = '". $pageID ."' ORDER BY FIELD(lang, '". LANGUAGE ."') DESC ")->result_array();
        $data['page_translation'] = array();
        foreach($page_translation as $lang){
            $data['page_translation'][$lang['lang']] = $lang;
            $this->db->where(
                array('pageID' => $pageID, 'lang' => $lang['lang'])
            );
            $productDescription = $this->db->get('product_translation')->row();
            $data['page_translation'][$lang['lang']]['productDescription'] = empty($productDescription) ? '' :  $productDescription->productDescription;
        }

        $this->db->where('pageID', $pageID);
        $data['product'] = $this->db->get('product')->row_array();

        $this->db->where('pageID', $pageID);
        $data['product_price'] = array();
        $product_price = $this->db->get('product_price')->result_array();
        foreach($product_price as $priceRow){
            $data['product_price'][$priceRow['currency']] = $priceRow;
        }


        $this->db->where('pageID', $pageID);
        $data['product_translation'] = $this->db->get('product_translation')->result_array('productDescription');
        return $data;
    }


    public function getProductsByVendor($vendorID){
        $qs = "SELECT p.pageID, p.lastUpdate, p.state, p.allParentPageIDs, pr.productID, pr.stockAmount, pr.productType, p.defaultLanguage, pr.mainImage, prt.productDescription,
                (SELECT pageName FROM page_translation WHERE pageID = p.pageID AND lang = p.defaultLanguage) AS pageName
                FROM product pr
                JOIN page p ON p.pageID = pr.pageID
                JOIN product_translation prt ON prt.pageID = p.pageID
                WHERE pr.vendorID = '". $vendorID ."' 
                GROUP BY p.pageID";
        $products = $this->db->query($qs)->result();
        foreach($products as $key => $product){
            $parentPageIDs = substr($product->allParentPageIDs, 2);
            $parentPage = $this->db->query("SELECT GROUP_CONCAT(pageName SEPARATOR '/') AS parentPage FROM page_translation WHERE pageID IN(". $parentPageIDs .") AND lang = '". $product->defaultLanguage ."'")->row();
            $products[$key]->parentPage = $parentPage->parentPage;
            $products[$key]->price = $this->db->query("SELECT currency, price FROM product_price  WHERE pageID = '". $product->pageID ."' ORDER BY FIELD(currency, '". $this->data['vendor']['preferredCurrency'] ."') DESC")->result_array();
        }
        return $products;
    }


    public function updateTranslation($data){
        $data['pageName'] = htmlspecialchars($data['pageName'], ENT_HTML5|ENT_QUOTES, 'UTF-8');
        $data['metaTitle'] = htmlspecialchars($data['metaTitle'], ENT_HTML5|ENT_QUOTES, 'UTF-8');
        $data['metaDescription'] = htmlspecialchars($data['metaDescription'], ENT_HTML5|ENT_QUOTES, 'UTF-8');
        $data['productDescription'] = htmlspecialchars($data['productDescription'], ENT_HTML5|ENT_QUOTES, 'UTF-8');

        $this->db->query("INSERT INTO page_translation (pageID, lang, pageName, metaTitle, metaDescription)
                    VALUES ('". $data['pageID'] ."', '". $data['language'] ."', '". $data['pageName'] ."', '". $data['metaTitle'] ."', '". $data['metaDescription'] ."')
                    ON DUPLICATE KEY UPDATE lang = '". $data['language'] ."', pageName = '". $data['pageName'] ."', metaTitle = '". $data['metaTitle'] ."', metaDescription = '". $data['metaDescription'] ."'");

        $this->db->query("INSERT INTO product_translation (pageID, lang, productDescription)
                    VALUES ('". $data['pageID'] ."', '". $data['language'] ."', '". $data['productDescription'] ."')
                    ON DUPLICATE KEY UPDATE lang = '". $data['language'] ."', productDescription = '". $data['productDescription'] ."'");
    }


    public function computePriceByPreferredCurrency($data){
        $pageID = $this->input->post('pageID');
        $preferredCurrency = $this->input->post('preferredCurrency');
        $currency = $this->input->post('currency');

        $priceInPreferredCurrency = $this->db->query("SELECT price FROM product_price WHERE pageID = '". $pageID ."' AND currency = '". $preferredCurrency ."'")->row_array();
        $rateInPreferredCurrency = $this->db->query("SELECT rateByEUR FROM currency WHERE currencyCode = '". $preferredCurrency ."'")->row_array();
        $rate = $this->db->query("SELECT rateByEUR FROM currency WHERE currencyCode = '". $currency ."'")->row_array();

        $priceInEUR = $priceInPreferredCurrency['price'] / $rateInPreferredCurrency['rateByEUR'];
        $price = round($priceInEUR * $rate['rateByEUR'], 2);
        return $price;
    }


    public function deleteProductDefinitively(){
        $pageID = $this->uri->segment(4);
        $this->db->where('pageID', $pageID)->delete('page');
        $this->db->where('pageID', $pageID)->delete('page_translation');
        $this->db->where('pageID', $pageID)->delete('product');
        $this->db->where('pageID', $pageID)->delete('product_price');
        $this->db->where('pageID', $pageID)->delete('product_translation');

        $pageMediaPath = str_replace('_PAGE_ID_', $pageID, DEFAULT_PAGE_MEDIA_PATH);
        if(is_dir($pageMediaPath)){
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($pageMediaPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $fileinfo) {
                $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
                $todo($fileinfo->getRealPath());
            }

            rmdir($pageMediaPath);
        }
    }


    public function getProductImages($pageID){
        $images = $this->db->query("SELECT * FROM product_images WHERE pageID = '". $pageID ."' ORDER BY sort")->result_array();
        return $images;
    }


    public function createProductImage($imgPath, $smallImgPath, $thumbnailPath, $pageID){

        if(!is_dir($imgPath)){mkdir($imgPath, 0705);}
        if(!is_dir($smallImgPath)){mkdir($smallImgPath, 0705);}
        if(!is_dir($thumbnailPath)){mkdir($thumbnailPath, 0705);}

        if (!empty($_FILES)) {
            $this->load->library('image_lib');
            $tempFile = $_FILES['upload_product_images_input']['tmp_name'];
            $imgPathInfo = pathinfo($_FILES['upload_product_images_input']['name']);
            $imgName = $this->checkImageName($imgPathInfo, $imgPath);
            $targetImage     = $imgPath . $imgName;
            $targetSmall     = $smallImgPath . $imgName;
            $targetThumbnail = $thumbnailPath . $imgName;
            move_uploaded_file($tempFile, $targetImage);
            copy($targetImage, $targetSmall);
            copy($targetImage, $targetThumbnail);
            $this->resizeThumbnail($targetImage, 1280);
            $this->resizeThumbnail($targetSmall, 360);
            $this->resizeThumbnail($targetThumbnail, 120);
            $data = array(
                'pageID' => $pageID,
                'imgName' => $imgName,
            );
            $this->db->insert('product_images', $data);
            $id = $this->db->insert_id();
            $returnArray = array(
                'pageID' => $pageID,
                'productMediaID' => $id,
                'imgName' => $imgName,
                'imagesPath' => '/' . PRODUCTS_IMAGES_PATH . $pageID . '/thumbnail/',
            );
            return json_encode($returnArray);
        }
        else{
            return 'false';
        }
    }

    public function checkImageName($imgPathInfo, $imgPath){
        $imgName = convertToUrlFriendly($imgPathInfo['filename'], true) . '.' . $imgPathInfo['extension'];
        $i = 2;
        while(file_exists($imgPath . $imgName)){
            $imgName = convertToUrlFriendly($imgPathInfo['filename'], true) . '-' . $i . '.' . $imgPathInfo['extension'];
            $i++;
        }
        return $imgName;
    }

    public function resizeThumbnail($path, $size){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $size;
        $config['height']       = $size;
        $config['thumb_marker'] = '';
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            echo '<p>' . $this->image_lib->display_errors() . '</p>';
        }
    }




}