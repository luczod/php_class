<?php

  $x = 10;

  $y =& $x; // =&

  echo $x;
  echo "\n";
  echo $y;
  echo "\n";

  $y = 15;

  echo "ref";
  echo "\n";
  echo $x;
  echo "\n";
  echo $y;
  echo "\n";

?>