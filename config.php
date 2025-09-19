<?php
$host = "localhost";
$user = "root";       // default user XAMPP
$pass = "";           // default password kosong
$db   = "warga_rt";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
