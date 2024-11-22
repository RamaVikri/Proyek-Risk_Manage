<?php
session_start();
if($_SESSION['status']==""){
    header("location:index.php?pesan=gagal");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Menu</title>
</head>
<body>
    <h1>Selamat Datang di Risk Management</h1>
    <ul class="ul-navbar">
                <li class="li-navbar">
                    <a href="" class="a-navbra">Menu</a>
                </li>
                <li class="li-navbar">Laporan
                    <?php if ($_SESSION['status'] == "admin") { ?>    
                        <select name="LAPORAN" id="kategori">
                            <option value="tabel">Tabel</option>
                            <option value="kelompok">Kelompok Resiko</option>
                            <option value="sumber">Sumber Resiko</option>
                        </select>
                    <?php } elseif ($_SESSION['status'] == "dekan") { ?>    
                        <select name="LAPORAN" id="kategori">
                            <option value="tabel">Tabel</option>
                            <option value="kelompok">Kelompok Resiko</option>        
                        </select>
                    </li>
                    <?php } ?>
                <li class="li-navbar">
                    <a href="" class="a-navbra">Input</a>
                </li>
            </ul>



    <a href="../logout.php">Logout</a>
</body>
</html>