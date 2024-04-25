<?php
require 'conn.php';
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $password_hash_from_db = $row['password'];
        
        $password_input_hash = md5($password);
        
        if ($password_input_hash === $password_hash_from_db) {
            echo 
             $_SESSION['Login Berhasil!!'] = true;
        header('Location: admin_control.php');
        exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container-log">
    <h2>Login</h2>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <div class="user">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="pass">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>

        <p>
            Belum punya akun??
        <a href="register.php" class="register-btn">Register</a>
        </p>
        
    </form>
    
    </div>
</body>
</html>
