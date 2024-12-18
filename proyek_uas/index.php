<?php
require_once 'conn.php';
require_once 'login.php';

session_start();
$user = new VerifLogin($conn);

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if($user -> login($username, $password)){
     
        
    }else {
        echo "password atau Username salah";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYEK</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="desktop-1">

    <h2 class="aplikasimanajemenrisiko">Risk O+</h2>

    <img src="assets/Opang.jpg" class="logoMerk"/>
    <div class="deskripsi" >Manage Ur Risk With Risk O+ App 
        O+ means Opang</div>



<div class="rectangle1"></div>
    <form  method="post">
        <div class="rectangle5"></div>
            <div class="silahkanlogin">Silahkan Login</div>
        <label class="username" for="">Username</label>
        <input type="text" name="username" class = "rectangle3" placeholder="Username..." required = "required"> 
        <label class="password" for="">Password</label>
        <input type="password" name="password" class = "rectangle6" placeholder="Password..." required = "required">
        
            <button class="rectangle2">LOGIN</button>
    </form>


    






</body>
</html>