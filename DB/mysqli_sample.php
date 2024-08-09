<?php 
 // check in php.ini if mysqli is enabled
 // phpAdmin
$host = "localhost";
$user = "root";
$pass = "";
$db = "name_database";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_errno) {
    echo "Connection error! <br>";
    echo "Error: " . $conn->connect_error;
}

/* SIMPLE QUERY */
$q1 = "CREATE TABLE products (name VARCHAR(55), desc VARCHAR(100))";
$q2 = "SELECT * FROM products";
$q3 = "DROP TABLE products";

$result = $conn->query($q2);
print_r($result);

$conn->close();

/* INSERT */
$table = "products";
$name = "Cup";
$desc = "cup of coffee";

$q = "INSERT INTO $table (nome, desc) VALUES ('$name', '$desc')";
$conn->query($q);

$conn->close();

/* PREPARED INSERT */
$name = "Cup";
$desc = "cup of coffee";

$stmt = $conn->prepare("INSERT INTO products (nome, desc) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $desc); // s = string, i = integer, d = double
$stmt->execute();

/* PREPARED SELECT */
$id = 4;

$stmt = $conn->prepare("SELECT * FROM itens WHERE id > ?");
$stmt->bind_param("i", $id); // s = string, i = integer, d = double
$stmt->execute();

$result = $stmt->get_result();
$items = $result->fetch_all(); // all rows
$item = $result->fetch_row(); // one row

print_r($items);
print_r($item);
$conn->close();

?>