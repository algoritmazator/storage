<?php
session_start();
require_once '../auth/vendor/connect.php';

$name = $_POST['name'];
$password = md5($_POST['password']);
$check_user = mysqli_query($connect, "SELECT * FROM `admin` WHERE `name` = '$name' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_name'] = $user['name'];
    header('Location: adminpanel.php');
} else {
     $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: index.php');
}
?>