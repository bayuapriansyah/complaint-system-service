<?php
session_start();
require 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM customer WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    $_SESSION['successDelete'] = "Berhasil menghapus";
    header('location: dashboard.php');
    exit();
} else {
    $_SESSION['gagalDelete'] = "Gagal Menghapus";
    header('location: dahsboard.php');
    exit;
}
?>