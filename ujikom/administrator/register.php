<?php
require 'conn.php';
session_start();

// Jika pengguna sudah login, arahkan ke halaman utama
if (isset($_SESSION['Login Berhasil!!']) && $_SESSION['Login Berhasil!!']) {
    header('Location: index.php');
    exit;
}

// Inisialisasi variabel error
$error = '';

// Memproses data yang dikirim dari formulir registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Periksa apakah username sudah digunakan
    $check_username_sql = "SELECT * FROM admins WHERE username='$username'";
    $check_username_result = $conn->query($check_username_sql);
    
    if ($check_username_result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Jika username tersedia, lakukan registrasi
        $password_hash = md5($password); // Untuk keperluan contoh, gunakan MD5 untuk menyimpan password
        $register_sql = "INSERT INTO admins (nama_admin,username, password) VALUES ('$nama_admin','$username', '$password_hash')";
        
        if ($conn->query($register_sql) === TRUE) {
            // Registrasi berhasil, arahkan ke halaman login
            header('Location: login.php');
            exit;
        } else {
            $error = "Terjadi kesalahan saat melakukan registrasi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrasi Administrator</title>
</head>
<body>
    <div class="container-log">
    <h2>Registrasi Administrator</h2>
    <?php if(!empty($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
    <div class="nama">
            <label for="nama_admin">Nama:</label>
            <input type="text" id="nama_admin" name="nama_admin" required>
        </div>
        <div class="user">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="pass">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Registrasi</button>
    </form>
    </div>
</body>
</html>
