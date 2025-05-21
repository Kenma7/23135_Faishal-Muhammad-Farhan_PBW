<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kuliah"; // ganti nama database sesuai yang kamu pakai

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
