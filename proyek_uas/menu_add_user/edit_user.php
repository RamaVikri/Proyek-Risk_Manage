<?php
require_once '../conn.php';
require_once '../util/user.php';
session_start();

$id = $_GET['id'];
// membuat objek class
$user = new User($conn);
$data_user =  data("SELECT * FROM user WHERE id = $id")[0];

function data($isiData){
    global $conn;
    $result = mysqli_query($conn, $isiData);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

if(isset($_POST['submit'])){
   
    //menggunakan method
    if($user-> ubah_data($_POST)> 0){
        echo"<script>
        alert('data berhasil diupdate!');
        document.location.href = 'daftar_user.php';
        </script>";
    } else{
       echo "<script>
        alert('data gagal diupdate!');
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
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
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
                <?php if ($_SESSION['status'] == 'admin'): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <!-- fitur khusus admin end-->
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Edit Data Pengguna</h1>
        
            <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data_user["id"]; ?>">
                    <ul>
                        <li>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" required value="<?= $data_user["nama"]; ?>">
                        </li>
                        <li>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" required value="<?= $data_user["username"]; ?>">
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <!-- Tidak mengisi password dengan data sebelumnya, biarkan kosong -->
                            <input type="password" name="password" id="password">
                        </li>
                        <li>
                            <label for="status">Jabatan</label>
                            <select name="status" id="status" required>
                                <option value="rektor" <?= $data_user["status"] == "rektor" ? "selected" : ""; ?>>Rektor</option>
                                <option value="Wakil Rektor" <?= $data_user["status"] == "Wakil Rektor" ? "selected" : ""; ?>>Wakil Rektor</option>
                                <option value="Dekan" <?= $data_user["status"] == "Dekan" ? "selected" : ""; ?>>Dekan</option>
                                <option value="Kaprodi" <?= $data_user["status"] == "Kaprodi" ? "selected" : ""; ?>>Kaprodi</option>
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
                            <button type="submit" name="submit">Ubah Data</button>
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