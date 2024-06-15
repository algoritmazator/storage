<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);
    
    // Проверка, заблокирован ли пользователь
    if ($user['blocked'] == 1) {
        // Если пользователь заблокирован, отправляем сообщение об ошибке и перенаправляем на страницу входа
        $_SESSION['message'] = 'Ваш аккаунт заблокирован. Обратитесь к администратору для разблокировки. При запросе обязательно укажите ваш логин, под которым вы зарегестрированны. <br><a href="./support.php">Обратиться в поддержку</a>.';
        header('Location: ../index.php');
        exit();
    }

    // Обновляем last_login для данного пользователя
    mysqli_query($connect, "UPDATE users SET last_login = NOW() WHERE id = '" . $user['id'] . "'");

    // Если пользователь не заблокирован, производим вход и перенаправляем на профиль
    $_SESSION['user'] = [
        "id" => $user['id'],
        "full_name" => $user['full_name'],
        "avatar" => $user['avatar'],
        "email" => $user['email']
    ];

    header('Location: ../profile.php');

} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: ../index.php');
}
?>
