<?php
session_start();
require_once '../conn.php';
// include '../conn.php';
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
    <h1>AplikasiRisk Management</h1>
    <h2>Selamat Datang <?php echo($_SESSION['nama'])?> <br>  </h2>
    <h3>Anda masuk sebagai <?php echo($_SESSION['status'] )?></h3>
    <ul class="ul-navbar">
        <li class="li-navbar">
                    <a href="" class="a-navbra">Menu</a>
        </li>
        <li class="li-navbar">Laporan
            <?php if ($_SESSION['status'] == $data['status']) { ?>    
            <select name="LAPORAN" id="kategori">
                <option value="tabel">Tabel</option>
                <option value="kelompok">Kelompok Resiko</option>
                <option value="sumber">Sumber Resiko</option>
            </select>
            <?php } elseif ($_SESSION['status'] == 'dekan' ){ ?>    
            <select name="LAPORAN" id="kategori">
                <option value="tabel">Tabel</option>
                <option value="kelompok">Kelompok Resiko</option>        
            </select>
        </li>
        <?php } elseif($_SESSION['status'] == 'kaprodi') { ?>
            <select name="LAPORAN" id="kategori">
                <option value="tabel">Tabel</option>        
            </select> 
        <?php } else { echo "kamu siapa"; }?>
        <li class="li-navbar">
                <a href="" class="a-navbra">Input</a>
        </li>
    </ul>
    <a href="../logout.php">Logout</a>
</body>
</html>