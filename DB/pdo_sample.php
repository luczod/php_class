<?php 
// check in php.ini if php_pdo is enabled
$host = "localhost";
$user = "root";
$pass = "";
$db = "name_database";

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

/* INSERT */
$stmt = $conn->prepare("INSERT INTO products (name, desc) VALUES (:name, :desc)");

$name = "Monitor stand";
$desc = "Monitor stand helps improve your ergonomics while working in front of the monitor.";

$stmt->bindParam(":name", $name);
$stmt->bindParam(":desc", $desc);

$stmt->execute();

/* UPDATE */
$id = 5;
$name = "Keyboard Microsoft";
$desc = "The Microsoft Wired Keyboard presents a complete solution for your needs.";

$stmt = $conn->prepare("UPDATE products SET name = :name, desc = :desc WHERE id = :id");

$stmt->bindParam(":id", $id);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":desc", $desc);

$stmt->execute();

?>