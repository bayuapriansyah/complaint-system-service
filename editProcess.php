<?php
session_start();
include 'koneksi.php';

$id = $_POST['id'];
$nama_depan = $_POST['firstName'];
$nama_belakang = $_POST['lastName'];
$email = $_POST['email'];
$no_hp = $_POST['nohp'];
$tanggallahir = $_POST['birthdate'];
$alamat = $_POST['alamat'];


$sql = "UPDATE customer SET 
nama_depan = '$nama_depan',
nama_belakang = '$nama_belakang', 
email = '$email',
no_hp = '$no_hp',
alamat = '$alamat',
tanggal_lahir = '$tanggallahir' WHERE id = '$id'
";
if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Data berhasil diubah!";
    header('Location: dashboard.php');
    exit();
} else {
    $_SESSION['error'] = "Gagal mengubah data";
    header('location: dashboard.php');
    exit();
}
?>