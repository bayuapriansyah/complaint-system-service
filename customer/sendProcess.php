<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['email'])) {
    header("Location: loginCust.php");
    exit();
}
$email = $_SESSION['email'];
$nama = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$deskripsi = $_POST['deskripsi'];
$foto = $_POST['foto'];

$sql = "INSERT INTO keluhan (nama, lokasi, deskripsi, foto, email) VALUES (?, ?, ?, ?, ?) ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssss", $nama, $lokasi, $deskripsi, $foto, $email);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Keluhan berhasil dikirim!";
        header("Location: index.php");
        exit();
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Gagal mengirim keluhan: " . $conn->error;
    header("Location: index.php");
    exit();
}
?>