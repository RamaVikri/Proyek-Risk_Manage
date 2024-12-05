<?php
require_once '../conn.php';
require_once '../util/function.php';

if(isset($_POST['submit'])){
   

    if(tambah_data($_POST)> 0 ){
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Tambah Data Pengguna</h1>

    <form action="" method="post">
            <ul>
                <li>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" require>
                </li>
                <li>
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" require>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" require>
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
</body>
</html>