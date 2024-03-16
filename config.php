<?php

$h ="localhost";
$u ="root";
$p ="";
$db ="restaurant";

$conn = mysqli_connect($h,$u,$p,$db);

if (!$conn) {
    echo "Not COnnected". mysqli_connect_error();
} 

?>