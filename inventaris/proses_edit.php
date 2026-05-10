<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_obat = $_POST['nama_obat'];
    $kategori = $_POST['kategori'];
    $no_batch = $_POST['no_batch'];
    $expired = $_POST['tgl_kadaluarsa']; 
    $sisa_stok = $_POST['sisa_stok'];
    $lokasi = $_POST['lokasi'];
    $supplier = $_POST['supplier'];

    $query = "UPDATE inventaris SET 
                nama_obat = '$nama_obat', 
                kategori = '$kategori', 
                no_batch = '$no_batch', 
                expired = '$expired', 
                sisa_stok = '$sisa_stok', 
                lokasi = '$lokasi', 
                supplier = '$supplier' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
    header("Location: index.php?pesan=update_berhasil"); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
}
?>