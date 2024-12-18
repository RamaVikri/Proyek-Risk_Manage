<?php
$conn = mysqli_connect('localhost', 'root','', 'riskman');

if ($conn -> connect_error) {
    die("Koneksi gagal: " . $conn -> connect_error);
}



