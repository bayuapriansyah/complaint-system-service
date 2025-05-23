<?php
session_start();

include "../koneksi.php";

$email = $_POST['email'];

$query = "SELECT email FROM customer WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
} else {
    $_SESSION['loginError'] = "Email tidak terdaftar";
    header("Location: loginCust.php");
    exit();
}
?>