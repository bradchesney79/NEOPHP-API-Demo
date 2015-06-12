<?php

include_once("dBug.php");

$clean = array();
$response = array();

$endPoint = 'https://query.yahooapis.com/v1/public/yql?';
$queryFront = 'q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20%20%28%22';

/*
$clean['stocks'] = url_encode(
				  str_replace(
					',', //needle
					' ', // this is what replaces the needle in the haystack
					$_POST['stocks'] // haystack  <-- sent from the user
				  )
				);
*/

$clean['stocks'] = urlencode(str_replace(',',' ',$_GET['stocks']));

ctype_alnum ( string $text )

$queryEnd = '%22%29&diagnostics=true&env=http%3A%2F%2Fdatatables.org%2Falltables.env&format=json';

$curlRequest = curl_init();


curl_setopt($curlRequest, CURLOPT_URL, $endPoint . $queryFront . $clean['stocks'] . $queryEnd);
curl_setopt($curlRequest, CURLOPT_HEADER, 0);


$response = curl_exec($curlRequest);

// close cURL resource, and free up system resources
curl_close($curlRequest);


$phpObject = json_decode($response,true));


new dBug($phpObject);


?>
