<?php
defined('BASEPATH') or exit('No direct script access allowed');


error_reporting(E_ALL);
ini_set('display_errors', 1);

class Currency_rates extends CI_Controller{


    public $ratesSource = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
    public $rates;


    public function __construct(){
        parent::__construct();
        $this->rates = $this->readFeed();
        dmp( $this->rates );

        foreach($this->rates as $currency){
            $this->db->set('rateByEUR', $currency['rate'])->where('currencyCode', $currency['currencyCode'])->update('currency');
        }
    }


    public function index(){
    }


    public function readFeed(){
        $xmlString = simplexml_load_file($this->ratesSource);
        if(!$xmlString){
            die('FEED INACCESSIBLE');
        }
        $currency = array();
        $currencyRates = array();
        foreach ($xmlString->Cube->Cube->Cube as $element) {
            $currency[] = array(
                (array)$element['currency'], (array)$element['rate']
            );
        }
        foreach( $currency as $key => $value){
            $currencyRates[$value[0][0]] = array(
                'currencyCode' => $value[0][0],
                'rate' => $value[1][0],
            );
        }
        return $currencyRates;
    }

}