<?php
session_start();
require_once 'config/database.php';

$error_msg = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (trim($password) == trim($row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            header("Location: index.php");
            exit();
        } else {
            $error_msg = "Password salah!";
        }
    } else {
        $error_msg = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMART ED Apotek Bintang Surya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-container">
        <div class="left-panel">
            <div class="brand-top">
                <img src="logo-icon.png" alt="Icon" class="logo-img">
                <div>
                    <strong>SMART ED APOTEK</strong><br>
                    <span>BINTANG SURYA</span>
                </div>
            </div>

            <div class="branding-text">
                <h1>Akurasi Data Apotek</h1>
                <p>Kelola stok dan pantau masa kadaluarsa dengan sistem yang presisi</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="login-box">
                <h2>Selamat Datang</h2>
                <p class="subtitle">Silakan masuk ke akun SMART ED Anda</p>

                <form action="index.php" meythod="POST">
                    <div class="input-group">
                        <label>Email atau Username</label>
                        <input type="text" placeholder="Gmail">
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label>Password</label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>
                        <input type="password" placeholder="password">
                    </div>

                    <div class="checkbox-row">
                        <input type="checkbox" id="remember">
                        <label for="remember">Biarkan saya tetap masuk</label>
                    </div>

                    <button type="submit" class="btn-login">Masuk &rarr;</button>
                </form>

                <p class="footer-text">Belum punya akun? <a href="register.php">Daftar</a></p>
            </div>
        </div>
    </div>

</body>
</html>