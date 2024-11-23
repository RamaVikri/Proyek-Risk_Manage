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
    <title>PRROYEK</title>
</head>
<body>
    <h2>LOGIN</h2>

    <form  method="post">
        <label for="">Username</label>
        <input type="text" name="username" class = "form_login" placeholder="username..." required = "required"> 
        <label for="">Password</label>
        <input type="password" name="password" class = "form_login" placeholder="username..." required = "required"> 
        <button class=" tombol_login">LOGIN</button>
    </form>
</body>
</html>