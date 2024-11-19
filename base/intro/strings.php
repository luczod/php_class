<?php

$age = 15;

echo "He is $age old"; // interpolation
echo 'He is $age old';

$str1 = "This string is too long";
echo strlen($str1); // LENGTH
for($i = 0; $i < strlen($str); $i++) {
    echo "$str[$i] <br>";
}

/* SEARCH STRING*/
$str = "Testing the strpos method, with strpos we can find strings";
$findTest = strpos($str, "strpos"); // the first occurrence
$word = strrpos($str, "method"); // str(r)pos = the last occurrence 
echo "$findTest <br>";

$findTest2 = strpos($str, "Java");
echo "$findTest2 <br>";
if($findTest2 === false) {
  echo "Word not found <br>";
}

/* ARRAY TO STRING */
$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr);
// Hello World! Beautiful Day!

/* STRING TO ARRAY */
$str = "Hello world. It's a beautiful day.";
print_r (explode(" ",$str)); // separated by white space
// Array ( [0] => Hello [1] => world. [2] => It's [3] => a [4] => beautiful [5] => day. )

?>