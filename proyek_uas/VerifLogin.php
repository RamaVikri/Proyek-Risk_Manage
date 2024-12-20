<?php

class VerifLogin{
    private $conn;
    public function __construct($conn)
    {
        $this-> conn = $conn;
    }   
public function login($username, $password){
    $login = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($this-> conn, $login);

    if(mysqli_num_rows($result)>0){
        $data = mysqli_fetch_assoc($result);
    
        $_SESSION['username'] = $data['username'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['nama'] = $data['nama'];


	//login sbg admin
	if($data['status']=="admin"){
		
		// $_SESSION['username'] = $username;
		//  $_SESSION['status'] = "admin";
		header("location:menu_halaman/about.php");
 
        exit();
    }else if($data['status']=="dekan"){
        // $_SESSION['username'] = $username;
		// $_SESSION['status'] = "dekan";

        header("location:menu_halaman/about.php");
        exit();
    }else if($data['status']=="rektor" || $data['status']=="Rektor"){
        // $_SESSION['username'] = $username;
		// $_SESSION['status'] = "dekan";

        header("location:menu_halaman/about.php");
        exit();
    }else if($data['status']=="kaprodi" || $data['status']=="Kaprodi" ){
        // $_SESSION['username'] = $username;
		// $_SESSION['status'] = "dekan";

        header("location:menu_halaman/about.php");
        exit();
    }
    else{
        header("location:index.php?pesan=gagal");
    }
} else{
    // echo "data tidak ditemukan";
}
        
}
}
