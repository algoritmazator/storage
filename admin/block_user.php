<?php
session_start();
require_once '../auth/vendor/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'], $_GET['action'])) {
    $user_id = $_GET['id'];
    $action = $_GET['action'];

    // Выполняем запрос на блокировку/разблокировку пользователя
    if ($action == 'block') {
        $update_query = "UPDATE users SET blocked = 1 WHERE id = ?";
    } elseif ($action == 'unblock') {
        $update_query = "UPDATE users SET blocked = 0 WHERE id = ?";
    } else {
        $_SESSION['message'] = 'Недопустимое действие';
        header('Location: adminpanel.php');
        exit();
    }

    $stmt = $connect->prepare($update_query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Пользователь успешно ' . ($action == 'block' ? 'заблокирован' : 'разблокирован');
    } else {
        $_SESSION['message'] = 'Ошибка при выполнении действия: ' . $connect->error;
    }

    header('Location: adminpanel.php');
} else {
    $_SESSION['message'] = 'Недопустимые параметры';
    header('Location: adminpanel.php');
}
?>
