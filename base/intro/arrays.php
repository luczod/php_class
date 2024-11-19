<?php
$arr = [1,2,3];
print_r($arr);
echo $arr[0];

$cars = array("Volvo", "BMW", "Toyota");
$cars[1] = "Ford";

/* ASSOCIATIVE ARRAYS */
$dict = ['name'=>'shark','color'=>'gray','location'=>'ocean']; 
print_r($dict);
echo $dict['color'];

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo $car["model"];

/* ARRAYS_KEYS */
$arr3 = array("Volvo"=>"XC90","BMW"=>"X5","Toyota"=>"Highlander");
print_r(array_keys($arr3)); // Array ( [0] => Volvo [1] => BMW [2] => Toyota )

/* ARRAYS_MAP */
function myfunction($num){
  return($num * $num);
}

$arr4 = array(1,2,3,4,5);
print_r(array_map("myfunction",$arr4)); // Array ( [0] => 1 [1] => 4 [2] => 9 [3] => 16 [4] => 25 )


?>