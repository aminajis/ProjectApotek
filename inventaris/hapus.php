<?php
require_once '../config/database.php'; 

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    $query = mysqli_query($conn, "DELETE FROM inventaris WHERE id = '$id'");

    if ($query) {
        header("Location: index.php?pesan=hapus_berhasil");
        exit();
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>