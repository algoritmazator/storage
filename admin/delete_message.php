<?php
session_start();
require_once '../auth/vendor/connect.php';

// Проверяем, был ли передан ID записи для удаления
if (isset($_GET['id'])) {
    $message_id = $_GET['id'];

    // Выполняем запрос на удаление записи с указанным ID
    $delete_query = "DELETE FROM feedback_messages WHERE id = ?";
    $stmt = $connect->prepare($delete_query);
    $stmt->bind_param("i", $message_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Запись успешно удалена';
    } else {
        $_SESSION['message'] = 'Ошибка при удалении записи: ' . $connect->error;
    }

    // Перенаправляем администратора на страницу со списком сообщений
    header('Location: support_user.php');
} else {
    $_SESSION['message'] = 'Не удалось получить ID записи для удаления';
    header('Location: support_user.php');
}
?>
