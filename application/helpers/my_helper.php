<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * kill cache
 */
function kc(){
    if(ENVIRONMENT == 'development' || ENVIRONMENT == 'testing'){
        return '?r=' . md5(microtime());
    }
    else{
        return '';
    }
}


/**
 * Print language
 */
function pl($current, $default){
    if(isset($current) && !empty($current)){
        return $current;
    }
    elseif(isset($default) && !empty($default)){
        return $default;
    }
    else{
        return '';
    }
}


function markErrorField($errorFields, $field){
    if(in_array($field, $errorFields)){
        return true;
    }
    return false;
}

function fillInputValue($value, $original = false){
    if( empty($value) ){
        $value = false;
    }
    if( empty($original) ){
        $original = false;
    }
    if(!$value && $original){
        return $original;
    }
    elseif($value && !$original){
        return $value;
    }
    else{
        return '';
    }
}


function activeMenuItem($uri, $uriPart, $uriSegment = false){
	if(is_integer($uriSegment)){
		if( $uri->segment( $uriSegment ) == $uriPart ){
			echo ' active';
		}
	}
	else{
		if( $uri->uri_string() == $uriPart ){
			echo ' active';
		}
	}
}

if ( ! function_exists('rootCategoryName'))
{
    function rootCategoryName($category){
        $categoryArray = explode('|', $category);
        return $categoryArray;
    }
}


if ( ! function_exists('p'))
{
    function p($var){
       if(isset($var)) {
           echo $var;
       }
    }
}
	
if ( ! function_exists('object_empty'))
{
	function object_empty( $obj ){
		foreach( $obj as $x ) return false;
		return true;
	}
}
        
if ( ! function_exists('dmp'))
{   
	function dmp($var, $deep = false, $asStr = false){
		$arr = debug_backtrace(0,1);
		if($deep){
			ini_set('xdebug.var_display_max_depth', '10000');
			ini_set('xdebug.var_display_max_data', '10000');
			ini_set('xdebug.var_display_max_children', '10000');
		}
		
		echo '<div style="clear:both; position: relative; z-index: 100000000000000000">';
		echo '<pre>';
		echo '<b>File: </b>' . str_replace($_SERVER['DOCUMENT_ROOT'], "", $arr[0]['file']) . '<br>';
		echo '<b>Line: </b>' . $arr[0]['line'] . '<br>';
// 		echo '<b>Var: </b>' . write($var) . '<br>';
		if($asStr !== true)
			var_dump($var);
		else
			var_dump($var, $asStr);
// 		debug_zval_dump($var);
		echo '</pre>';
		echo '<div style="clear:both">&nbsp;</div>';
		echo '</div>';
	}
}



function addVal($var, $product){
    if(isset($product->{$var}))
        echo $product->{$var};
}


function domainFromUrl($url){
    if(empty($url)){
        return '';
    }
    if(strpos($url,'://') === false){
        $url = 'http://' . $url;
    }
    $urlParts = parse_url($url);
    $domain = str_replace('www.', '', $urlParts["host"]);
    return $domain;
}
	
	
if ( ! function_exists('prnt'))
{   
	function prnt($var, $printToLog = false){
    	$arr = debug_backtrace(0,1);
	    if(!$printToLog){
    	    echo '<div style="clear:both; position: relative; z-index: 100000000000000000">';
    	    echo '<pre>';
    	    echo '<b>File: </b>' . str_replace($_SERVER['DOCUMENT_ROOT'], "", $arr[0]['file']) . '<br>';
    	    echo '<b>Line: </b>' . $arr[0]['line'] . '<br>';
            echo $var;
            echo '</pre>';
            echo '<div style="clear:both">&nbsp;</div> . "\n\n"';
	    }
	    else{
	        echo "\n";
	        echo 'File: ' .  str_replace($_SERVER['DOCUMENT_ROOT'], "", $arr[0]['file']) . "\n";
	        echo 'line: ' .   $arr[0]['line'] . "\n";
	        echo $var . "\n\n";
	    }
	}
}


if ( ! function_exists('mb_ucfirst')){
	function mb_ucfirst($str) {
		$fc = mb_strtoupper(mb_substr($str, 0, 1));
		return $fc.mb_substr($str, 1);
	}
}


if ( ! function_exists('reformatDate'))
{
    function reformatDate($date, $format = "d.m.Y") {
        return date($format, strtotime($date));
    }
}

if ( ! function_exists('skMonth'))
{
	function skMonth($date) {
		$month = date('n', strtotime($date));
		static $monthNames = array(1 => 'Január', 'Február', 'Marec', 'Apríl', 'Máj', 'Jún', 'Júl', 'August', 'September', 'Október', 'November', 'December');
		return $monthNames[$month];
	}
}

if ( ! function_exists('$date'))
{
	function skDay($date) {
		$day = date('w', strtotime($date));
		static $dayNames = array('nedeľa', 'pondelok', 'utorok', 'streda', 'štvrtok', 'piatok', 'sobota');
		return $dayNames[$day];
	}
}



// if ( ! function_exists('logger'))
// {
// 	function logger( $error ){
// 		$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/error.log", "a");
// 		$row =  now() .' - '.$error . "\r\n";
// 		fwrite($fp, $row);
// 		fclose($fp);
// 	}
// }



if ( ! function_exists('logger'))
{
	function logger( $dir, $line ){
	    $logFilePath = FCPATH . 'log/'. $dir .'/' . date('Y-m-d') . '.log';
	    if(!file_exists($logFilePath)){
                $fp = fopen($logFilePath, 'w');
                fclose($fp);
            }
            $logFileContent = file_get_contents($logFilePath);
            $newLine = now() . ' - ' . $line . "\r\n";
            $logFileContent = $newLine . $logFileContent;
            $fp = fopen($logFilePath, 'w');
            fwrite($fp, $logFileContent);
            fclose($fp);
	}
}



/**
 * ak premenna existuje, vrati premennu, ak nie, vrati default
 */
if ( ! function_exists('ifVarNotExistPrintDefault'))
{
	function ifVarNotExistPrintDefault($var, $default = ""){
		if(isset($var) && !empty($var))
			return $var;
		else 
			return $default;
	}
}



/**
 * vráti posledný časť url
 */
if ( ! function_exists('getLastUriPart')){
	function getLastUriPart($url = ''){
        $pathFragments = explode('/', $url);
        $lastUriPart = end($pathFragments);
        return $lastUriPart;
	}
}



/**
 * skrati string na zadanu dlzku
 */
if ( ! function_exists('shortenString'))
{
	function shortenString($str, $length = 100){
		$croppedStr = mb_substr($str, 0, $length);
		if($croppedStr < $str){
			$croppedStr = $croppedStr.'...';
		}
		return $croppedStr;
	}
}


/**
 * 2 funkcie pre kapču. Prvá vráti náhodný captha text,
 * druhá font 
 */
if ( ! function_exists('captchaCode'))
{
	function captchaCode($length = 5){
		$str = '';
		$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for($i = 0 ; $i < $length; $i++){
			$start = rand( 0 , strlen($chars) -1 );
			$str .= substr($chars, $start, 1);
		}
		return $str;
	}
}
if ( ! function_exists('captchaFont'))
{
	function captchaFont(){
		$fonts = array('scriban.ttf', 'serpntb.ttf', 'stenciln.ttf', 'typewriterA602.ttf');
		return $fonts[ rand(0, 3) ];
	}
}



if ( ! function_exists('youtubeIdFromUrl')){
	function youtubeIdFromUrl($url) {
		$pattern = '%^# Match any youtube URL
			    (?:https?://)?  # Optional scheme. Either http or https
			    (?:www\.)?      # Optional www subdomain
			    (?:             # Group host alternatives
			      youtu\.be/    # Either youtu.be,
			    | youtube\.com  # or youtube.com
			      (?:           # Group path alternatives
			        /embed/     # Either /embed/
			      | /v/         # or /v/
			      | .*v=        # or /watch\?v=
			      )             # End path alternatives.
			    )               # End host alternatives.
			    ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
			    ($|&).*         # if additional parameters are also in query string after video id.
			    $%x';
		$result = preg_match($pattern, $url, $matches);
		if (false !== $result) {
			return $matches[1];
		}
		return false;
	}
}


if ( ! function_exists('vimeoIdFromUrl')){
	function vimeoIdFromUrl($url) {
		$result = (int) substr(parse_url($url, PHP_URL_PATH), 1);
		if (false !== $result) {
			return $result;
		}
		return false;
	}
}


if ( ! function_exists('zerofill')){
	function zerofill($mStretch, $iLength = 2){
		$sPrintfString = '%0' . (int)$iLength . 's';
		return sprintf($sPrintfString, $mStretch);
	}
}


/*
 * proforma faktura
 */
if ( ! function_exists('createInvoiceNumber')){
	function createInvoiceNumber() {
		$filePath = FCPATH . '/assets/lastInvoiceNo-'. LANGUAGE .'.inc';
		$lastInvoiceNo = file_get_contents($filePath);
		$currentYear = date("Y");
		$lastInvoiceYear = substr($lastInvoiceNo, 1, 4);
		
		switch(LANGUAGE){
		    case 'sk':
		        $firstDigit = 1;
		        break;
		    case 'cz':
		        $firstDigit = 4;
		        break;
		    default:
		        $firstDigit = 0;
		}
		
		if($lastInvoiceYear != $currentYear){
			$invoiceNumber = $firstDigit . $currentYear . '001';
		}
		else{
			if(substr($lastInvoiceNo, -3) == '999' && strlen($lastInvoiceNo) == 8){
				$invoiceNumber = '1' . $currentYear . '1000';
			}
			else{
				$invoiceNumber = $lastInvoiceNo + 1;
			}
		}

		$fp = fopen($filePath, 'w+');
		fwrite($fp, $invoiceNumber, 100);
		fclose($fp);
		return $invoiceNumber;
	}
}


/**
 * @param string $invoiceFormat possible values: YYYYMMDDNN, YYMMDDNNNN, YYYYMMNNNN, YYYYMMNN
 * @return invoice number
 */
if ( ! function_exists('createInvoiceNumber____________________________')){
	function createInvoiceNumber____________________________($invoiceFormat = 'YYYYMMDDNN') {
		switch($invoiceFormat){
			default:
				$digitsPartLength = 2;
				$datePart = date("Ymd");
		}
	
		$datePartLength = strlen($datePart);
		$filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/lastInvoiceNo.inc';
		$lastInvoiceNo = file_get_contents($filePath);
		$fp = fopen($filePath, 'w+');
		
		$sPrintfString = '%0' . $digitsPartLength . 's';
		if( $datePart == substr($lastInvoiceNo, 0, $datePartLength) )
			$invoiceNumber = $lastInvoiceNo+1;
		else 
			$invoiceNumber = $datePart . sprintf($sPrintfString, 1);
		
		fwrite($fp, $invoiceNumber, 100);
		return $invoiceNumber;
	}
}



/**
 * function returns right verbal form of quantity
 * it uses db table measure_unit
 */
if ( ! function_exists('measureUnitNameByQuantity')){
	function measureUnitNameByQuantity($umeasureUnitString, $quantity){
		$measureUnitNameForms = explode(';', $umeasureUnitString);
		foreach($measureUnitNameForms as $value){
			$measureUnitNameForm = explode(':', $value);
			
			if(strpos($measureUnitNameForm[0], '-') !== false){
				$number = explode('-', $measureUnitNameForm[0]);
				if(empty($number[1]))
					$number[1] = PHP_INT_MAX;
				if($quantity >= $number[0] && $quantity <= $number[1]){
					return $measureUnitNameForm[1];
				}
			}
			else{
				if($quantity == $measureUnitNameForm[0]){
					return $measureUnitNameForm[1];
				}
			}
		}
	}
}


/**
 * ak nie je definovaná konštanta, vypíše jej názov 
 */
if ( ! function_exists('printConstant')){
    function printConstant($constant){
        if(defined($constant))
            echo constant($constant);
        else
            echo ucfirst( strtolower( str_replace('_', ' ', $constant ) ) );
    }
}


if ( ! function_exists('normalizeSort')){
    function normalizeSort($table, $idFieldName, $sortFieldName, $parentFieldName = false, $parentID = false){
        $CI =& get_instance();

        $where = $parentFieldName != false && $parentID != false ? " WHERE ". $parentFieldName ." = '". $parentID ."' " : '';
        $pages = $CI->db->query("SELECT ". $idFieldName ." FROM ". $table . $where . " ORDER BY ". $sortFieldName ."")->result();

        $i = 1;
        foreach($pages as $page){
            $CI->db->query("UPDATE ". $table ." SET ". $sortFieldName ." = '". $i ."' WHERE ". $idFieldName ." = '". $page->{$idFieldName} ."' LIMIT 1");
//            echo "<pre>\n" . "UPDATE ". $table ." SET ". $sortFieldName ." = '". $i ."' WHERE ". $idFieldName ." = '". $page->{$idFieldName} ."' LIMIT 1</pre>";
            $i++;
        }
    }
}


if ( ! function_exists('normalizeSort2')){
    function normalizeSort2($table, $idFieldName, $sortFieldName, $parentFieldName = false, $parentID = false){
        $CI =& get_instance();
//dmp(1);die;
        $where = $parentFieldName != false && $parentID != false ? " WHERE ". $parentFieldName ." = '". $parentID ."' " : '';
        $pages = $CI->db->query("SELECT ". $idFieldName ." FROM ". $table . $where . " ORDER BY created")->result();

        $i = 1;
        foreach($pages as $page){
            $query = "UPDATE ". $table ." SET ". $sortFieldName ." = '". $i ."' WHERE ". $idFieldName ." = '". $page->{$idFieldName} ."' LIMIT 1";
            $CI->db->query($query);
//            echo "<pre>\n" . "UPDATE ". $table ." SET ". $sortFieldName ." = '". $i ."' WHERE ". $idFieldName ." = '". $page->{$idFieldName} ."' LIMIT 1</pre>";
            $i++;
        }
    }
}







if ( ! function_exists('ru2lat')){
    function ru2lat($str)
    {
        $tr = array(
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d", "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n", "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch", "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", "я"=>"ya", " "=>"-", ","=>"", ":"=>"", ";"=>"","—"=>"", "–"=>"-"
        );
        return strtr($str,$tr);
    }
}
/**
 * convert given string to url friendly 
 * and cut it to given length
 * TODO: cutting is not finished
 */
if ( ! function_exists('convertToUrlFriendly'))
{
	function convertToUrlFriendly($str, $convertSlashes = false){
	    $str = ru2lat($str);
		$char = array(	// letters
                        "ö" => "o", "ű" => "u", "ő" => "o", "ü" => "u", "ł" => "l", "ż" => "z", "ń" => "n", "ć" => "c", "ę" => "e", "ś" => "s", 
                        "ŕ" => "r", "á" => "a", "ä" => "a", "ĺ" => "l", "č" => "c", "é" => "e", "ě" => "e", "í" => "i", "ď" => "d", "ň" => "n", 
                        "ó" => "o", "ô" => "o", "ř" => "r", "ů" => "u", "ú" => "u", "š" => "s", "ť" => "t", "ž" => "z", "ľ" => "l", "ý" => "y", 
                        "Ŕ" => "R", "Á" => "A", "Ä" => "A", "Ĺ" => "L", "Č" => "C", "É" => "E", "Ě" => "E", "Í" => "I", "Ď" => "D", "Ň" => "N", 
                        "Ó" => "O", "Ô" => "O", "Ř" => "R", "Ů" => "U", "Ú" => "U", "Š" => "S", "Ť" => "T", "Ž" => "Z", "Ľ" => "L", "Ý" => "Y", "Ä" => "A",		
						// other chars
                        "+" => "-", "?" => "-", "!" => "-", " " => "-", " " => "-", "|" => "-", "." => "-", "--" => "-", "---" => "-", "----" => "-",
		                "€" => "-eur", "$" => "-usd", "Ł" => "gbp", "," => '-', ")" => '-', "(" => '-', "&" => '-'

		          );
// 		$str = urlencode($str);+
		$str = str_replace('%', 'percent', $str);
		$str = strtr ( $str , $char );
        if($convertSlashes){
            $str = str_replace('/', '-', $str);
        }
		$str = trim($str);                          // no open ends
		$str = strtolower($str);                    // all lowercase
		$str = preg_replace('/[\W]+\./', '-', $str);  // substitute non-word characters with -
		$str = preg_replace('/^-*|-*$/', '', $str); // no beinging or ending -
		$str = strtr ( $str , $char );
		return $str;
	}
}

/**
 * generates random string with given length
 * if no parameter is given, string length will be 10 chars
 */
if ( ! function_exists('randomString')){
	function randomString($length = 10){
		$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
		$str = substr(str_shuffle($chars),0,$length);
		$str = substr_replace($str, '-', 6, 0);
		$str = substr_replace($str, '-', 3, 0);
		return $str;
	}
}



/**
 * sformatuje cislo na cenu
 */
if ( ! function_exists('priceFormat')){
    function priceFormat($number, $currency, $currencyDivider = ' ', $showCurrency = true){
		$number = number_format($number, 2, ',', " ");
		if($showCurrency === true)
		    $number = $number . $currencyDivider . $currency;
		return $number;
	}
}


if ( ! function_exists('truncate')){
	function truncate($string, $length = 100, $append = "..."){
		strlen($string) <= intval($length) ? $string = $string : $string = substr($string, 0, $length) . $append;
		return $string;
	}
}


/**
 * Formátovanú cenu prevedie na desatinné číslo
 */
if ( ! function_exists('priceStringToDecimal')){
	function priceStringToDecimal($string){
		$string = preg_replace("/[^0-9,.]/", "", $string);
		$string = str_replace(',', '.', $string);
		return (float)$string;
	}
}


/**
 * Generate password
 * @return passwort string
 * @param int $passwordLength
 * @param bool $useSpecialChars (use special chars or not)
 */
if ( ! function_exists('createPassword')){
	function createPassword( $passwordLength = 8 , $useSpecialChars = false ){
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$specialChars = "()#&@[]";
		if($useSpecialChars == true){
			$chars = $specialChars.$chars.$specialChars;
		}
		
		$charsLength = strlen($chars);
		$startMax = $charsLength - $passwordLength;
		$start = mt_rand(0, $startMax);
		
		return substr( str_shuffle( $chars ) , $start , $passwordLength );
	}
}


/**
 * Vytvorí 10 miestny variabilný symbol v tvare YYMM0000XXX
 * 
 */
if ( ! function_exists('variabilnySymbol')){
	function variabilnySymbol($cartID){
		$cartIDLength = strlen($cartID);
		$numberOfZeros = 10 - 4 - $cartIDLength;

		$vs = date('ym');
		$vs .= str_repeat('0', $numberOfZeros);
		$vs .= $cartID;
		$vs = substr_replace($vs, ' ', 3, 0);
		$vs = substr_replace($vs, ' ', 7, 0);

		return $vs;
	}
}


/**
 * Vrári aktuálny timestamp pre db
 */
if ( ! function_exists('now')){
	function now(){
		return date("Y-m-d H:i:s");
	}
}


/**
 * Tagu <option> priradí, alebo nepriradí element selected
 */
if ( ! function_exists('selected')){
	function selected($str1, $str2){
		if($str1 == $str2){
			return ' selected="selected" ';
		}
		return '';
	}
}


if ( ! function_exists('flushBuffers')){
	function flushBuffers( $var ){
		ob_flush();
		flush();
		echo $var.'<br>';
	}
}


if ( ! function_exists('crawlerDetect')){
	function crawlerDetect($USER_AGENT)
	{
		$crawlers = array(
				'Google' => 'Google',
				'MSN' => 'msnbot',
				'Rambler' => 'Rambler',
				'Yahoo' => 'Yahoo',
				'AbachoBOT' => 'AbachoBOT',
				'accoona' => 'Accoona',
				'AcoiRobot' => 'AcoiRobot',
				'ASPSeek' => 'ASPSeek',
				'CrocCrawler' => 'CrocCrawler',
				'Dumbot' => 'Dumbot',
				'FAST-WebCrawler' => 'FAST-WebCrawler',
				'GeonaBot' => 'GeonaBot',
				'Gigabot' => 'Gigabot',
				'Lycos spider' => 'Lycos',
				'MSRBOT' => 'MSRBOT',
				'Altavista robot' => 'Scooter',
				'AltaVista robot' => 'Altavista',
				'ID-Search Bot' => 'IDBot',
				'eStyle Bot' => 'eStyle',
				'Scrubby robot' => 'Scrubby',
				'Facebook' => 'facebookexternalhit',
		);
		// to get crawlers string used in function uncomment it
		// it is better to save it in string than use implode every time
		// global $crawlers
		$crawlers_agents = implode('|',$crawlers);
		if (strpos($crawlers_agents, $USER_AGENT) === false)
			return false;
		else {
			return TRUE;
		}
	}
}










function createTreeArrayFromArray($flat, $idKey = null, $parentIdKey){
    $grouped = array();
    
    foreach ($flat as $sub){
    	if(is_object($sub))
    		$sub = (array)$sub;
        $grouped[$sub[$parentIdKey]][] = $sub;
    }

    $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
        foreach ($siblings as $k => $sibling) {
            $id = $sibling[$idKey];
            if(isset($grouped[$id])) {
                $sibling['children'] = $fnBuilder($grouped[$id]);
            }
            $siblings[$k] = $sibling;
        }
        return $siblings;
    };
	if(!isset($grouped[0]))
		$tree = array();
	else
		$tree = $fnBuilder($grouped[0]);
    return $tree;
}


function maskEmail($email){
    $final_str = '';
    $string = explode('@', $email);
    $leftlength = strlen($string[0]);
    $string2 = explode('.', $string[1]);
    $string2len = strlen($string2[0]);
    $leftlength_new = $leftlength-1;
    $first_letter = substr($string[0], 0,1);
    $stars = '';
    $stars2 = '';
    for ($i=0; $i < $leftlength_new; $i++) {
        $stars .= '*';
    }
    for ($i=0; $i < $string2len; $i++) {
        $stars2 .= '*';
    }
    $stars;
    return $final_str .= $first_letter.$stars.'@'.$stars2.'.'.$string2[1];
}



function toSelect ($arr, $parentID, $depth=0) {
	$html = '';
	foreach ( $arr as $v ) {
		$v = (array)$v;
		$disabled = '';
		if($depth == 0){
			$disabled = ' disabled="disabled"';
		}
		$html.= '<option value="' . $v['genreID'] . '" '.$disabled.'>';
		$html.= str_repeat('&nbsp; &middot; &nbsp;', $depth);
		$html.= $v['genreName'] . '</option>' . PHP_EOL;
		if ( array_key_exists('children', $v) ) {
			$html.= toSelect($v['children'], $v['parentGenreID'], $depth+1);
		}
	}
	return $html;
}

	

	function priceToSQL($price)
	{
		$price = preg_replace('/[^0-9\.,]*/i', '', $price);
		$price = str_replace(',', '.', $price);
	
		$price = round($price, 2);
		if(substr($price, -3, 1) == '.')
		{
			$price = explode('.', $price);
			$last = array_pop($price);
			$price = join($price, '').'.'.$last;
		}
		else
		{
			$price = str_replace('.', '', $price);
		}
	
		return $price;
	}



function toTable ($arr, $arrForSelectBox, $depth=0) {
	$html = '';
	foreach ( $arr as $v ) {
		$v = (array)$v;
		$html.= '<tr id="genre_' . $v['genreID'] . '">'. PHP_EOL;
		$html.= '<td>'.$v['genreID'].'</td>'. PHP_EOL;
		$html.= '<td>'.str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $depth) .'<span id="genreName_' . $v['genreID'] . '">'. $v['genreName'] .'</span></td>'. PHP_EOL;
		$html.= '<td class="inputCell"><input id="textInput_' . $v['genreID'] . '" type="text" name="genreName" value="' . $v['genreName'] . '"></td>'. PHP_EOL;
		$html.= '<td class="inputCell"><select id="selectBox_' . $v['genreID'] . '" name="">'. PHP_EOL;
		$html.= '<option value="0">Najvyššia úroveň</option>' . toSelect($arrForSelectBox, $v['parentGenreID']) . '</select></td>'. PHP_EOL;
		$html.= '<td align="right">';
		$html.= '<a class="tabuleEditIcon floppyButton" id="floppyButton_' . $v['genreID'] . '" title="Uložiť"><i class="fa fa-floppy-o"></i></a>';
		$html.= '<a class="tabuleEditIcon trashButton" id="trashButton_' . $v['genreID'] . '" title="Vymazať"><i class="fa fa-trash-o"></i></a>';
		$html.= '</td>'. PHP_EOL;
		$html.= '</tr>' . PHP_EOL . PHP_EOL;

		if ( array_key_exists('children', $v) ) {
			$html.= toTable($v['children'], $arrForSelectBox, $depth+1);
		}
	}
	return $html;
}


function w1250_to_utf8($text) {
    // map based on:
    // http://konfiguracja.c0.pl/iso02vscp1250en.html
    // http://konfiguracja.c0.pl/webpl/index_en.html#examp
    // http://www.htmlentities.com/html/entities/
    $map = array(
        chr(0x8A) => chr(0xA9),
        chr(0x8C) => chr(0xA6),
        chr(0x8D) => chr(0xAB),
        chr(0x8E) => chr(0xAE),
        chr(0x8F) => chr(0xAC),
        chr(0x9C) => chr(0xB6),
        chr(0x9D) => chr(0xBB),
        chr(0xA1) => chr(0xB7),
        chr(0xA5) => chr(0xA1),
        chr(0xBC) => chr(0xA5),
        chr(0x9F) => chr(0xBC),
        chr(0xB9) => chr(0xB1),
        chr(0x9A) => chr(0xB9),
        chr(0xBE) => chr(0xB5),
        chr(0x9E) => chr(0xBE),
        chr(0x80) => '&euro;',
        chr(0x82) => '&sbquo;',
        chr(0x84) => '&bdquo;',
        chr(0x85) => '&hellip;',
        chr(0x86) => '&dagger;',
        chr(0x87) => '&Dagger;',
        chr(0x89) => '&permil;',
        chr(0x8B) => '&lsaquo;',
        chr(0x91) => '&lsquo;',
        chr(0x92) => '&rsquo;',
        chr(0x93) => '&ldquo;',
        chr(0x94) => '&rdquo;',
        chr(0x95) => '&bull;',
        chr(0x96) => '&ndash;',
        chr(0x97) => '&mdash;',
        chr(0x99) => '&trade;',
        chr(0x9B) => '&rsquo;',
        chr(0xA6) => '&brvbar;',
        chr(0xA9) => '&copy;',
        chr(0xAB) => '&laquo;',
        chr(0xAE) => '&reg;',
        chr(0xB1) => '&plusmn;',
        chr(0xB5) => '&micro;',
        chr(0xB6) => '&para;',
        chr(0xB7) => '&middot;',
        chr(0xBB) => '&raquo;',
    );
    return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
}




