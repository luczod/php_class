<?php
  
  $categories = ["PHP","HTML","CSS","JavaScript","Bootstrap","Java","C#"];

  $colors = array("red", "green", "blue", "yellow");

  foreach ($colors as $x) {
    echo "$x <br>"; 
  }
  
?>
<aside>
    <h3 id="categories-title">Categories</h3>
    <ul id="categories-list">
        <?php foreach($categories as $category): ?>
        <li><a href="#"><?= $category ?></a></li>
        <?php endforeach; ?>
    </ul>
</aside>