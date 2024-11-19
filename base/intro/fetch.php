<?php
$cURL = 'https://api.github.com/repositories/1300192/issues?per_page=1&page=2';

function get_page($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}

$jsonobj = get_page($cURL);
// $jsonobj = curl_exec($cURL);
$obj = json_decode($jsonobj);
print_r($obj[0]);
print_r($obj[0]->timeline_url);
