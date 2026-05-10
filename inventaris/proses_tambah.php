<?php
include '../config/database.php';

$nama_obat = $_POST['nama_obat'];
$kategori  = $_POST['kategori'];
$no_batch  = $_POST['no_batch'];
$expired   = $_POST['expired'];
$stok      = $_POST['stok'];
$lokasi    = $_POST['lokasi']; 
$supplier  = $_POST['supplier']; 

$query = "INSERT INTO inventaris (nama_obat, no_batch, sisa_stok, expired, kategori, lokasi, supplier) 
          VALUES ('$nama_obat', '$no_batch', '$stok', '$expired', '$kategori', '$lokasi', '$supplier')";


if (mysqli_query($conn, $query)) {
    header("Location: index.php?pesan=tambah_berhasil");
    exit();
} else {
    echo "Gagal Tambah Data: " . mysqli_error($conn);
}
?>