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

	//login sbg admin
	if($data['status']=="admin1"){
		
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
	
		header("location:menu_halaman/halaman_admin.php");
 
        exit();
    }else if($data['status']=="dekan"){
        $_SESSION['username'] = $username;
		$_SESSION['level'] = "dekan";

        header("location:menu_halaman/halaman_dekan.php");
        exit();
    }
    else{
        header("location:index.php?pesan=gagal");
    }
} else{
    echo "data tidak ditemukan";
}
}
} 