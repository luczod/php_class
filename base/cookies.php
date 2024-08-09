<?php
  setcookie("name", "Wayne", time() + 3600);
  if(isset($_COOKIE['name'])) {
    $name = $_COOKIE['name'];
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if($name != ""): ?>
    <p>Welcome <?= $name ?></p>
    <?php endif; ?>
</body>

</html>