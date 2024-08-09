<?php 

  $nome;

  if(isset($nome)) {
    echo 'defined';
  } else {
    echo "undefined \n";
  }
  /* SHORTHAND IF */
  $a = 5;
  if ($a < 10) $b = 20;
  echo $b;

  $a2 = 13;
  $b = $a < 10 ? true : false;
  echo $b;

  /* ELSEIF */
  $t = date("H");

  if ($t < "10") {
    echo "Have a good morning!";
  } elseif ($t < "20") {
    echo "Have a good day!";
  } else {
    echo "Have a good night!";
  }

?>