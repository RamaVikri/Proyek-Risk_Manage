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
    <title>Daftar Pengguna</title>
    <style>
        /* CSS Internal */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #2c3e50;
            color: #fff;
            font-size: 14px;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
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
                <li><a href="../menu_halaman/riskRegister.php">Risk Register</a></li>
                <li><a href="../menu_halaman/riskList.php">Risk List</a></li>
                <li><a href="../menu_halaman/riskTreatments.php">Risk Treatments</a></li>

                <!-- fitur khusus admin -->
                <?php if ($_SESSION['status'] == 'admin'): ?>
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