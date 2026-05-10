<?php
$host     = "localhost";
$user     = "root";
$pass     = ""; 
$db_name  = "apotek_smart_ed";
$port     = 3307; 

$conn = mysqli_connect($host, $user, $pass, $db_name, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>