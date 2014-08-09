<?php 
include "vendor/autoload.php";

use Sunra\PhpSimple\HtmlDomParser;


function gwp( $url,$curl_data=NULL ) { 
    $options = array( 
        CURLOPT_RETURNTRANSFER => true,         // return web page 
        CURLOPT_HEADER         => false,        // don't return headers 
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects 
        CURLOPT_ENCODING       => "",           // handle all encodings 
        CURLOPT_USERAGENT      => "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",     // who am i 
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect 
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect 
        CURLOPT_TIMEOUT        => 120,          // timeout on response 
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects 
        CURLOPT_POST           => (!$curl_data) ? 0 : 1,            // i am sending post data 
        CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars 
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl 
        CURLOPT_SSL_VERIFYPEER => false,        // 
        CURLOPT_VERBOSE        => 1                // 
    ); 

    $ch      = curl_init($url); 
    curl_setopt_array($ch,$options); 
    $content = curl_exec($ch); 
    $err     = curl_errno($ch); 
    $errmsg  = curl_error($ch) ; 
    $header  = curl_getinfo($ch); 
    curl_close($ch); 

     // $header['errno']   = $err; 
     // $header['errmsg']  = $errmsg; 
     $header['content'] = $content; 
    return $header; 
}

for ($i=0; $i <500 ; $i++) { 

	$post_data = array(
	"view" => "",
	"min_id" => "",
	"q" => "Cauta acum...",
	"search[city_id]" => " ",
	"search[region_id]" => " ",
	"search[district_id]" => " 0",
	"search[dist]" => " 0",
	"search[category_id]" => " 84",
	"page" => $i,
	);

	$data = gwp("http://olx.ro/ajax/search/list/", $post_data);

	$content = $data["content"];

	$dom = HtmlDomParser::str_get_html($content);
	// fucking premium links
	$i1 = 0;
	foreach ($dom->find('td.offer') as $element) {
	    if (@$element->find('a.detailsLinkPromoted', 0)->href) {
			continue; 
	}

	$title = trim($element->find('h3', 0)->plaintext);
	$link = $element->find('a.detailsLink', 0)->href;
	$price = trim($element->find('p.price', 0)->plaintext);
	$locatia = trim($element->find('small span', 0)->plaintext);
	$model = trim(str_replace($locatia, "", $element->find('.breadcrumb', 0)->plaintext)) ;


	$car = R::dispense('cars');
	$dupz = R::findOne('link', ' link = ? ', array($link));
	if ($dupz == null){

	$car->title = $title;
	$car->link = $link;
	$car->price = $price;
	$car->locatia = $locatia;
	$car->model = $model;
	R::store($car);
	}

	/*echo $title;
	echo $link;
	echo $price;
	echo $locatia;
	echo $model;*/
	
	
	print $i1;

}
print $i;

sleep(1);	
}