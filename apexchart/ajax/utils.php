<?php

use EasyPDO\EasyPDO;

require "../libs/EasyPDO.php";

$bd = new EasyPDO();
$results = $bd->select("SELECT * FROM (SELECT * FROM medidas ORDER BY created_at DESC LIMIT 10) foo ORDER BY created_at");
$res = [];

if ($bd->affectedRows < 10) {
    $num = 10 - $bd->affectedRows;
    // create an array with a number of data to complete 10
    $res = array_fill(0, $num, 0);
}

// create a data array
foreach ($results as $result) {
    $res[] = intval($result->valor);
}

// return json EasyPDO - WARNING - Username has no password defined.[76,34,10,20,30,40,50,60,50,40]
echo json_encode($res);
