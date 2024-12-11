<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'cerdas_cermat';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Koneksi Gagal: ' . $conn->connect_error);
}
?>
