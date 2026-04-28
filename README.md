Project Apotek Smart ED
Sistem manajemen apotek berbasis web untuk pemantauan stok obat dengan fitur Earliest Deadline (ED).
Penjelasan Alur Sistem:
1. Autentikasi Admin
Sistem dimulai dengan pengecekan akses. Jika user belum masuk, bakal dilempar ke halaman Login. Buat admin baru, disediain halaman Sign In buat daftarin akun asisten apoteker atau pemilik biar bisa dapet akses ke dashboard.
2. Dashboard (Home)
Setelah login berhasil, admin langsung masuk ke Beranda. Di sini isinya ringkasan statistik, kayak total stok obat yang ada sama notifikasi penting soal obat yang udah masuk masa kritis.
3. Manajemen Stok & Monitoring
- inventaris: Nampilin semua tabel obat. Bisa cari, edit, atau hapus data.
- Input Stok: Form buat nambahin obat baru dengan fitur **Auto-generate Nomor Batch**.
- Monitoring: Khusus buat mantau tanggal kadaluarsa (Klasifikasi Aman, Mendekati Kadaluarsa, dan Kadaluarsa).
4. Rekapitulasi Laporan & Pengaturan
Admin bisa buat laporan bulanan/mingguan dan mengelola profil akun di menu pengaturan.
5. Logout
Membersihkan session dan kembali ke halaman login demi keamanan data.
