<?php
function sumEvenNumbers($a){
    $count = 0;
    for ($i = 2; $i <= $a; $i+=2) {
        $count += $i;  
    }
    
    return $count;
    
}

echo sumEvenNumbers(6);