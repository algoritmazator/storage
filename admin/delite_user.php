<?php
session_start();
require_once '../auth/vendor/connect.php';

// Проверяем, авторизован ли администратор
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Проверяем, был ли передан идентификатор пользователя для удаления
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Выполняем запрос на удаление пользователя
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $connect->prepare($delete_query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Пользователь успешно удален';
    } else {
        $_SESSION['message'] = 'Ошибка при удалении пользователя: ' . $connect->error;
    }

    // Перенаправляем администратора на страницу админпанели
    header('Location: adminpanel.php');
} else {
    $_SESSION['message'] = 'Неверный идентификатор пользователя';
    header('Location: adminpanel.php');
}
?>
