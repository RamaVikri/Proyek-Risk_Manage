<?php
require_once 'conn.php';
require_once 'VerifLogin.php';

session_start();
$user = new VerifLogin($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        // Redirect or handle successful login
        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Password atau Username salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk O+ - Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="desktop-1">
    <div class="container">
        <div class="left-section">
            <img src="assets/uin.png" alt="Logo" class="logoMerk">
            <h2 class="aplikasimanajemenrisiko">Risk O+</h2>
            <p class="deskripsi">Manage Ur Risk With Risk O+ App <br> O+ means Opang</p>
        </div>
        <div class="login-section">
            <div class="rectangle1">
                <div class="rectangle5">
                    <h3 class="silahkanlogin">Silahkan Login</h3>
                </div>
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
                <?php endif; ?>
                <form method="post" class="login-form">
                    <label class="username" for="username">Username</label>
                    <input type="text" id="username" name="username" class="rectangle3" placeholder="Username..." required>
                    
                    <label class="password" for="password">Password</label>
                    <input type="password" id="password" name="password" class="rectangle6" placeholder="Password..." required>
                    
                    <button type="submit" class="rectangle2">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
