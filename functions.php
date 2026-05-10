<?php
session_start();

require_once 'config/database.php';

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function cleanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(stripslashes(trim($data))));
}

function generateNoBatch($conn) {
    $year = date('Y');
    $query = "SELECT MAX(no_batch) as max_id FROM stok_obat WHERE no_batch LIKE 'APT-$year-%'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    if ($data['max_id']) {
        $last_num = (int)substr($data['max_id'], 9);
        $new_num = str_pad($last_num + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $new_num = "001";
    }
    
    return "APT-$year-$new_num";
}

function tambahObat($data) {
    global $conn;
    $no_batch  = generateNoBatch($conn);
    $nama_obat = cleanInput($data['nama_obat']);
    $kategori  = cleanInput($data['kategori']);
    $jumlah    = cleanInput($data['jumlah_stok']);
    $expired   = cleanInput($data['expiry_date']);
    $rak       = isset($data['rak_penyimpanan']) ? cleanInput($data['rak_penyimpanan']) : '-';

    $query = "INSERT INTO stok_obat (no_batch, nama_obat, kategori, jumlah_stok, expiry_date, rak_penyimpanan) 
              VALUES ('$no_batch', '$nama_obat', '$kategori', '$jumlah', '$expired', '$rak')";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubahObat($data) {
    global $conn;
    
    $id         = cleanInput($data['id']);
    $nama_obat  = cleanInput($data['nama_obat']);
    $kategori   = cleanInput($data['kategori']);
    $jumlah     = cleanInput($data['jumlah_stok']);
    $expired    = cleanInput($data['expiry_date']);

    $query = "UPDATE stok_obat SET 
                nama_obat   = '$nama_obat', 
                kategori    = '$kategori', 
                jumlah_stok = '$jumlah', 
                expiry_date = '$expired' 
              WHERE id = $id";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

function hapusObat($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM stok_obat WHERE id = $id");
    return mysqli_affected_rows($conn);
}