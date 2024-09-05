<?php

use EasyPDO\EasyPDO;

require "libs/EasyPDO.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $bd = new EasyPDO();
    $parametros = [
        ':valor' => $_POST['number']
    ];
    $bd->insert("INSERT INTO medidas VALUES(0, :valor, NOW())", $parametros);

    echo "Value inserted successfully: " . $_POST['number'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Data</title>
</head>

<body>

    <p>Enter temperature:</p>
    <form action="enter_data.php" method="post">
        <label>Value:</label><br>
        <input type="number" name="number" min="0" max="100">
        <hr>
        <input type="submit" value="Save">
    </form>

</body>

</html>