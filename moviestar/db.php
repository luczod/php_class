<?php

  $db = "moviestar";
  $host = "localhost";
  $user = "root";
  $pass = "";

  $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);

  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
?>