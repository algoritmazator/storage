<?php
session_start();

if (isset($_GET['file_id'])) {
    // Проверяем аутентификацию пользователя
    if (!isset($_SESSION['user'])) {
        echo "Ошибка: пользователь не аутентифицирован.";
        exit();
    }

    $file_id = $_GET['file_id'];
    require_once 'vendor/connect.php';

    // Подготавливаем запрос для получения информации о файле
    $select_query = "SELECT * FROM `file` WHERE `id` = ?";
    if ($stmt = $connect->prepare($select_query)) {
        $stmt->bind_param("i", $file_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $file = $result->fetch_assoc();
            $file_path = 'http://lenapisano.temp.swtest.ru/uploads/' . $file['filename'];
$file_path = 'http://lenapisano.temp.swtest.ru/uploads_img/' . $file['filename'];

            // Проверяем, что пользователь имеет доступ к файлу
            if ($file['user_id'] != $_SESSION['user']['id']) {
                echo "Ошибка: доступ к файлу запрещен.";
                exit();
            }
            // Устанавливаем заголовки для скачивания файла
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit();
        } else {
            echo "Файл не найден.";
        }
    } else {
        echo "Ошибка при выполнении запроса: " . $connect->error;
    }
    $connect->close();
} else {
    echo "Идентификатор файла не указан.";
}
?>