<?php
session_start();
if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
}

echo $_SESSION['username'] . "<br> Anda telah login sebagai";
echo $_SESSION['level']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dekan</title>
</head>
<body>
    <h1>Selamat Datang di Halaman Dekan</h1>
    <p>Ini adalah halaman khusus untuk dekan.</p>
    <a href="../logout.php">Logout</a>
</body>
</html>