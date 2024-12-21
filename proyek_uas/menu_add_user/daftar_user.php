<?php
require_once '../conn.php';
require_once '../util/user.php';
session_start();


// membuat objek class
$user = new User($conn);
// menggunakan method
$data_user = $user-> data();


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Tambahkan file CSS -->
    <link rel="stylesheet" href="../css/daftar_user.css"> <!-- Tambahkan file CSS -->
    <title>Daftar Pengguna</title>

</head>

<body>
<div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Aplikasi Risk Management</h2>
            <p><small>Username: <?php echo $_SESSION['nama']; ?></small></p>
            <p><small>Status: <?php echo $_SESSION['status']; ?></small></p>
            <ul class="sidebar-menu">
                <li><a href="../menu_halaman/about.php">About</a></li>
                
                <li><a href="../menu_halaman/riskMatrix.php">Risk Matrix</a></li>
                
                </li>
                <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'Rektor'  || $_SESSION['status'] == 'Dekan') : ?>
                <li><a href="../menu_halaman/riskRegister.php">Risk Register</a></li>
                <?php endif; ?>

                <li><a href="../menu_halaman/riskList.php">Risk List</a></li>
                <li><a href="../menu_halaman/riskTreatments.php">Risk Treatments</a></li>

                <!-- fitur khusus admin -->
                <?php if ($_SESSION['status'] == 'admin' ||$_SESSION['status'] == 'Rektor' ): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <!-- fitur khusus admin end-->
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Menu Daftar User</h2>
            <a href="tambah_user.php">Tambah User</a>
        
        <table>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <!-- <th>Fakultas</th> -->
                <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($data_user as $row): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["nama"];?></td>
                <td><?= $row["status"];?></td>
                <!-- <td>belum paham</td> -->
                <td><a href="edit_user.php?id=<?= $row["id"];?>">edit</a> || <a href="delete_user.php?id=<?= $row["id"];?>">delete</a></td>
            </tr>
            <?php $i++?>
            <?php endforeach; ?>
        </table>    
        </div>
    </div>

</body>
</html>