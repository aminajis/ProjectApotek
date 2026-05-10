<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SMART ED Apotek Bintang Surya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> </head>
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
            <div class="login-box signin-box">
                <h2>Buat Akun Baru</h2>
                <p class="subtitle">Selamat Datang Di Sistem Manajemen SMART ED</p>

                <form action="auth_register.php" method="POST">
                    <div class="form-row">
                        <div class="input-group">
                            <label>NAMA LENGKAP</label>
                            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap Anda" required>
                        </div>
                        <div class="input-group">
                            <label>ROLE / JABATAN</label>
                            <select name="role" class="custom-select" required>
                                <option value="">Pilih Role</option>
                                <option value="Apoteker">Apoteker</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label>USERNAME</label>
                            <input type="text" name="username" placeholder="Masukkan username Anda" required>
                        </div>
                        <div class="input-group">
                            <label>EMAIL</label>
                            <input type="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label>PASSWORD</label>
                            <input type="password" name="password" placeholder="Masukkan password Anda" required>
                        </div>
                        <div class="input-group">
                            <label>KONFIRMASI PASSWORD</label>
                            <input type="password" name="confirm_password" placeholder="Konfirmasi password Anda" required>
                        </div>
                    </div>

                    <div class="checkbox-row">
                        <input type="checkbox" id="terms" required>
                        <label for="terms" style="font-size: 11px;">Saya setuju dengan <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> SMART ED Systems.</label>
                    </div>

                    <button type="submit" class="btn-login">Daftar &rarr;</button>
                </form>

                <p class="footer-text">Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>
        </div>
    </div>

</body>
</html>