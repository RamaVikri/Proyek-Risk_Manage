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
            <p><small>Username: <?php echo $_SESSION['nama']; ?></small></p>
            <p><small>Status: <?php echo $_SESSION['status']; ?></small></p>
            <ul class="sidebar-menu">
                <li><a href="about.php">About</a></li>
                
                <li><a href="riskMatrix.php">Risk Matrix</a></li>
                
                </li>
                <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'rektor'  || $_SESSION['status'] == 'dekan') : ?>
                <li><a href="riskRegister.php">Risk Register</a></li>
                <?php endif; ?>

                <li><a href="riskList.php">Risk List</a></li>
                <li><a href="riskTreatments.php">Risk Treatments</a></li>

                <!-- fitur khusus admin -->
                <?php if ($_SESSION['status'] == 'admin' ||$_SESSION['status'] == 'rektor' ): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <!-- fitur khusus admin end-->
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>About Page</h1>
            <p>Aplikasi Risk Management ini dirancang untuk membantu organisasi dalam mengidentifikasi, menganalisis, dan mengelola risiko yang mungkin terjadi pada berbagai aspek operasional maupun strategis. Aplikasi ini dibuat dengan tujuan meningkatkan efisiensi proses manajemen risiko, sehingga setiap risiko dapat diantisipasi, dimitigasi, dan dikelola dengan baik.</p>
            <h3>Fitur Utama Aplikasi</h3>
<h4>Risk Register</br>
Modul ini digunakan untuk mencatat seluruh risiko yang diidentifikasi, termasuk detail seperti:<br>
Tujuan dan proses bisnis terkait.</br>
Kategori risiko (strategis, finansial, operasional, dll.).</br>
Peristiwa risiko, penyebab, dan sumber risiko.</br>
Potensi kerugian dalam bentuk kualitatif maupun nominal.</br>
                </br>
Risk Matrix</br>
Fitur ini menyediakan matriks risiko yang membantu pengguna dalam menentukan tingkat risiko berdasarkan kemungkinan kejadian (likelihood) dan dampaknya (impact).</br>
</br>

Risk Treatment</br>
Modul ini membantu dalam merancang strategi mitigasi untuk setiap risiko yang teridentifikasi, seperti:</br>
Accept (menerima risiko tanpa tindakan tambahan).</br>
Reduce (mengurangi risiko melalui tindakan mitigasi tertentu).</br>
Lengkap dengan deskripsi tindakan mitigasi yang diperlukan.</br>
Evidence Management</br>
Pengguna dapat melampirkan bukti (evidence) terkait upaya mitigasi yang dilakukan. Data evidence ini disimpan secara langsung dalam tabel risiko yang relevan.</br>
</br>

Daftar User</br>
Fitur ini dikhususkan untuk admin aplikasi untuk mengelola pengguna yang memiliki akses ke aplikasi.</h4>
            <h3></h3>
            <h4></h4>
            <h3></h3>
            <h4></h4>
        </div>
    </div>
</body>
</html>
