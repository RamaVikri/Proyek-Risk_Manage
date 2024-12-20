<?php
require_once '../conn.php';
require_once '../util/user.php';
session_start();

// membuat objek class
$user = new User($conn);

if(isset($_POST['submit'])){
   $data = [
        "username" => $_POST['username'],
        "password" => $_POST['password'],
        "nama" => $_POST['nama'],
        "status" => $_POST['status']
   ];

// menggunakan method
    if($user -> tambah_data($data)> 0 ){
        echo"<script>
        alert('data berhasil ditambah!');
        document.location.href = 'daftar_user.php';
        </script>";
    } else{
       echo "<script>
        alert('data gagal ditambah!');
        document.location.href = 'daftar_user.php';
        </script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
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
                <li><a href="../menu_halaman/about.php">About</a></li>
                
                <li><a href="../menu_halaman/riskMatrix.php">Risk Matrix</a></li>
                
                </li>
                <li><a href="../menu_halaman/riskRegister.php">Risk Register</a></li>
                <li><a href="../menu_halaman/riskList.php">Risk List</a></li>
                <li><a href="#">Halaman B</a></li>

                <!-- fitur khusus admin -->
                <?php if ($_SESSION['status'] == 'admin1'): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <!-- fitur khusus admin end-->
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Tambah Data Pengguna</h1>
        
            <form action="" method="post">
                    <ul>
                        <li>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" required>
                        </li>
                        <li>
                            <label for="username">username</label>
                            <input type="text" name="username" id="username" required>
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                        </li>
                        <li>
                            <label for="status">Jabatan</label>
                            <select name="status" id="status" require>
                                <option value="rektor">Rektor</option>
                                <option value="Wakil Rektor">Wakil Rektor</option>
                                <option value="Dekan">Dekan</option>
                                <option value="Kaprodi">kaprodi</option>
                            </select>
                        </li>
                        <!-- <li>
                            <label for="fakultas">Fakultas</label>
                            <select name="fakultas" id="fakultas" require>
                                <option value="saintek">Saintek</option>
                                <option value="fishum">Fishum</option>
                                <option value="febi">Ekonomi dan Bisnis</option>
                            </select>
                        </li> -->
                        <li>
                            <button type="submit" name="submit">Tambahkan</button>
                        </li>
        
                            <!-- <select name="fakultas" id="fakultas">
                                <option value="biologi">biologi</option>
                                <option value="informatika">informatika</option>
                                <option value="matematika">Matematika</option>
                            </select> -->
                    </ul>
        
            </form>    
        </div>
    </div>
</body>
</html>