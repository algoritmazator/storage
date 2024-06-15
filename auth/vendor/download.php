<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php'); // Перенаправляем на страницу входа, если пользователь не авторизован
    exit();
}

// Проверяем, передан ли параметр file_id
if (!isset($_GET['file_id'])) {
    header('Location: ../profile.php'); // Если параметр file_id не передан, перенаправляем на профиль пользователя
    exit();
}

require_once 'connect.php';

$file_id = $_GET['file_id'];

// Запрос на получение информации о файле из базы данных
$select_query = "SELECT `filename`, `filetype`, `filecontent` FROM `file` WHERE `id` = ?";
if ($stmt = $connect->prepare($select_query)) {
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверяем, найден ли файл с указанным идентификатором
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Отправляем заголовки для скачивания файла
        header('Content-Type: ' . $row['filetype']); // Устанавливаем тип контента
        header('Content-Disposition: attachment; filename="' . $row['filename'] . '"');

        // Выводим содержимое файла
        echo $row['filecontent'];
    } else {
        echo "Файл не найден.";
    }

    $stmt->close();
} else {
    echo "Ошибка при подготовке запроса: " . $connect->error;
}

// Закрываем соединение с базой данных
$connect->close();
?>
