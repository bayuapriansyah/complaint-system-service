<?php
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
    echo "
    <script>
    alert('Data berhasil diubah');
    window.location.href = 'dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Gagal mengubah data');
    window.location.href = 'dashboard.php';
    </script>
    ";
}
?>