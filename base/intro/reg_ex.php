<?php

$str = "The rain in SPAIN falls mainly on the plains.";
$pattern = "/ain/i";

echo preg_match($pattern, $str); // 1 or 0
echo preg_match_all($pattern, $str); // the number of times the pattern was found in the string
echo preg_replace($pattern,"ain2",$str); // new string

?>