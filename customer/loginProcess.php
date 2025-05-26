<?php
session_start();

include "../koneksi.php";

$email = $_POST['email'];
if (isset($_POST['remember'])) {
    setcookie('email', $_POST['email'], time() + (86400 * 30), "/"); // 30 hari
} else {
    setcookie('email', '', time() - 3600, "/");
}

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