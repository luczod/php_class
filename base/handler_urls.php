<?php
$url2 ="https://horadecodar.com.br/?busca=php";

$arrayUrl = parse_url($url2);
$q = $arrayUrl["query"];

print_r(substr($q,6)); // php