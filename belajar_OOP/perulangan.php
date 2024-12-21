<?php

$angka = [1, 2,4,7,8];
$total = 0;
foreach ($angka as $z) {
    // $total = sizeof($z) 
    // for($i = 0; $i <= $total; $i++) {

    // }
    $total +=$z;   
    echo "$total . <br> "; 
}
echo $total;