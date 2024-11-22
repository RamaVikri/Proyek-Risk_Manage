<?php
$conn = mysqli_connect('localhost', 'root','', 'riskman');

if ($conn -> connect_error) {
    die("Koneksi gagal: " . $conn -> connect_error);
}

$query = "SELECT * FROM user ";
$result = mysqli_query($conn, $query);
$query_nama = mysqli_fetch_assoc($result);
// if(mysqli_connect_error()){
//     echo "koneksi gagal". mysqli_connect_error();
// }
