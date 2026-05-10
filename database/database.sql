CREATE TABLE IF NOT EXISTS stok_obat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_batch VARCHAR(50) UNIQUE NOT NULL, 
    nama_obat VARCHAR(100) NOT NULL,      
    kategori VARCHAR(50) NOT NULL,        
    keterangan TEXT,                      
    rak_penyimpanan VARCHAR(50),          
    expiry_date DATE,                     
    status ENUM('Tersedia', 'Habis') DEFAULT 'Tersedia', 
    jumlah_stok INT DEFAULT 0,
    tanggal_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_admin VARCHAR(100),
    last_login TIMESTAMP NULL
);

INSERT INTO users (username, password, nama_admin) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Utama');