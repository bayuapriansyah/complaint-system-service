<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'customerlist';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?> 
