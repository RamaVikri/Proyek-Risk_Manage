<?php
require_once '../conn.php';
require_once '../util/function.php';


$id = $_GET["id"];

if(delete($id)>0){
    echo"<script>
        alert('data berhasil dihapus!');
        document.location.href = 'daftar_user.php';
    </script>";
}