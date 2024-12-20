<?php
require_once '../conn.php';
require_once '../util/user.php';


// membuat objek class

$user = new User($conn);


$id = $_GET["id"];

// menggunakan method
if($user->delete($id)>0){
    echo"<script>
        alert('data berhasil dihapus!');
        document.location.href = 'daftar_user.php';
    </script>";
}