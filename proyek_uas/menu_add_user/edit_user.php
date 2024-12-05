<?php
require_once '../conn.php';
require_once '../util/function.php';

$id = $_GET['id'];
$data_user = data("SELECT * FROM user WHERE id = $id")[0];

if(isset($_POST['submit'])){
   

    if(ubah_data($_POST)> 0){
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
</head>
<body>
    <h1>Tambah Data Pengguna</h1>

    <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data_user["id"];?>">
            <ul>
                <li>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" require value="<?= $data_user["nama"];?>">
                </li>
                <li>
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" require value="<?= $data_user["username"];?>">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" require>
                </li>
                <li>
                    <label for="status">Jabatan</label>
                    <select name="status" id="status" require >
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
                    <button type="submit" name="submit">Ubah Data</button>
                </li>

                    <!-- <select name="fakultas" id="fakultas">
                        <option value="biologi">biologi</option>
                        <option value="informatika">informatika</option>
                        <option value="matematika">Matematika</option>
                    </select> -->
            </ul>

    </form>    
</body>
</html>