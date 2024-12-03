<?php
$conn = mysqli_connect('localhost', 'root','', 'riskman');

if ($conn -> connect_error) {
    die("Koneksi gagal: " . $conn -> connect_error);
}

$query = "SELECT * FROM user ";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
// if(mysqli_connect_error()){
//     echo "koneksi gagal". mysqli_connect_error();
// }
function data($isiData){
    global $conn;
    $result = mysqli_query($conn, $isiData);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah_data($data){
    global $conn;
    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];
    $status = $data["status"];

    $input_data = "INSERT INTO user (username, password, nama, status) VALUES ('$username', '$password', '$nama', '$status')";
    mysqli_query($conn, $input_data);

    return mysqli_affected_rows($conn);
}

function delete($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM user WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah_data($data){
    global $conn;
    $id = $data["id"];
    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];
    $status = $data["status"];

    $input_data = "UPDATE user SET username = '$username', password = '$password', nama ='$nama', status = '$status' WHERE id = $id";

    mysqli_query($conn, $input_data);

    return mysqli_affected_rows($conn);
}