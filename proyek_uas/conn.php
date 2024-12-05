<?php
$conn = mysqli_connect('localhost', 'root','', 'riskman');

if ($conn -> connect_error) {
    die("Koneksi gagal: " . $conn -> connect_error);
}


// if(mysqli_connect_error()){
//     echo "koneksi gagal". mysqli_connect_error();
// }
