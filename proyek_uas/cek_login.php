<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'conn.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND BINARY password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['status']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:menu_halaman/halaman_admin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="pegawai"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pegawai";
		// alihkan ke halaman dashboard pegawai
		header("location:halaman_pegawai.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['level']=="pengurus"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pengurus";
		// alihkan ke halaman dashboard pengurus
		header("location:halaman_pengurus.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>