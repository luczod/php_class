<?php 

function testStatic(){
    static $a = 0;
    $a++;
    echo "$a \n";
}
testStatic(); // 1
testStatic(); // 2
testStatic(); // 3