<?php
include 'koneksi.php';

session_start();
$firstname = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$email = $_POST['email'] ?? '';
$nohp = $_POST['nohp'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$tanggallahir = $_POST['birthdate'] ?? '';

$checkQuery = $conn->prepare("SELECT id FROM customer WHERE email = ?");
$checkQuery->bind_param("s", $email);
$checkQuery->execute();
$result = $checkQuery->get_result();
if ($result->num_rows > 0) {
    $_SESSION['errorCreate'] = "Email sudah terdaftar!";
    header("Location: Registrasi.php");
    exit();
}
$checkQuery->close();

$add = $conn->prepare("INSERT INTO customer (nama_depan, nama_belakang, email, no_hp, alamat, tanggal_lahir) VALUES (?,?,?,?,?,?)");
$add->bind_param("ssssss", $firstname, $lastName, $email, $nohp, $alamat, $tanggallahir);
if ($add->execute()) {
    $_SESSION['success'] = "Akun berhasil dibuat! Silahkan login";
    header("Location: Registrasi.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal membuat akun: " . $conn->error;
    header("Location: Registrasi.php");

}
$add->close();
$conn->close();
?>