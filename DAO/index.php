<?php

  include_once("db.php");
  include_once("dao/CarDAO.php");

  $carDao = new CarDao($conn);

  $cars = $carDao->findAll();

?>

<h1>Insert a car:</h1>
<form action="process.php" method="POST">
    <div>
        <label for="brand">Car brand:</label>
        <input type="text" name="brand" placeholder="Insert brand">
    </div>
    <div>
        <label for="km">Mileage:</label>
        <input type="text" name="km" placeholder="Insert a mileage">
    </div>
    <div>
        <label for="color">Car color:</label>
        <input type="text" name="color" placeholder="Insert a color">
    </div>
    <input type="submit" value="Save">
</form>
<ul>
    <?php foreach($cars as $car): ?>
    <li><?= $car->getBrand() ?> - <?= $car->getKm() ?> - <?= $car->getColor() ?></li>
    <?php endforeach; ?>
</ul>