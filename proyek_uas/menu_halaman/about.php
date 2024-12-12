<?php
session_start();
require_once '../conn.php';

if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Menu</title>
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Tambahkan file CSS -->
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Aplikasi Risk Management</h2>
            <h3>Selamat Datang</h3>
            <p><?php echo $_SESSION['nama']; ?></p>
            <p><small>Status: <?php echo $_SESSION['status']; ?></small></p>
            <ul class="sidebar-menu">
                <li><a href="about.php">About</a></li>
                <li>
                    <a href="#">Laporan</a>
                    <ul class="dropdown">
                        <li><a href="#">Tabel</a></li>
                        <li><a href="#">Kelompok Resiko</a></li>
                        <li><a href="#">Sumber Resiko</a></li>
                        <?php if ($_SESSION['status'] == 'admin'): ?>
                            <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="riskRegister.php">Risk Register</a></li>
                <li><a href="#">Halaman A</a></li>
                <li><a href="#">Halaman B</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>About Page</h1>
            <p>Selamat datang di halaman "About" aplikasi Risk Management.</p>
        </div>
    </div>
</body>
</html>
