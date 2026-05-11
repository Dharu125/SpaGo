<?php
// koneksi.php — Hubungkan ke database MySQL
// Sesuaikan username/password jika perlu
$host   = 'localhost';
$db     = 'home_spa';
$user   = 'root';
$pass   = '';          // default XAMPP kosong

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;padding:40px;color:red">
         <strong>Koneksi database gagal:</strong> ' . htmlspecialchars($conn->connect_error) . '
         <br>Pastikan XAMPP (MySQL) sudah berjalan dan database <em>home_spa</em> sudah diimpor.
         </div>');
}
