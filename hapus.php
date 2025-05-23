<?php
require 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM customer WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "
    <script>
    alert ('Berhasil menghapus');
    window.location.href = 'dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert ('Gagal menghapus');
    window.location.href = 'dashboard.php';
    </script>
    ";
}
?>