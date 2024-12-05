<?php
require_once '../conn.php';
require_once '../util/function.php';


$data_user = data("SELECT * FROM user ");

?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
</head>

<body>
    <h2>Menu Daftar User</h2>
    <a href="tambah_user.php">Tambah User</a>

<table border="4px">
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Fakultas</th>
        <th>Aksi</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach($data_user as $row): ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $row["nama"];?></td>
        <td><?= $row["status"];?></td>
        <td>belum paham</td>
        <td><a href="edit_user.php?id=<?= $row["id"];?>">edit</a>|| <a href="delete_user.php?id=<?= $row["id"];?>">delete</a></td>
    </tr>
    <?php $i++?>
    <?php endforeach; ?>
</table>    

</body>
</html>