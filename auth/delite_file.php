<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

require_once 'vendor/connect.php';

if (isset($_POST['file_id'])) {
    $file_id = $_POST['file_id'];

    // Запрос на получение информации о файле из базы данных
    $select_query = "SELECT `filename`, `filecontent` FROM `file` WHERE `id` = ?";
    if ($stmt = $connect->prepare($select_query)) {
        $stmt->bind_param("i", $file_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Проверяем, найден ли файл с указанным идентификатором
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            // Удаляем файл из папки загрузок
            $uploadFilePath = '../uploads/' . $row['filename'];
            if (file_exists($uploadFilePath)) {
                unlink($uploadFilePath); // Удаляем файл
            }

            // Удаляем запись о файле из базы данных
            $delete_query = "DELETE FROM `file` WHERE `id` = ?";
            if ($stmt_delete = $connect->prepare($delete_query)) {
                $stmt_delete->bind_param("i", $file_id);
                if ($stmt_delete->execute()) {
                    // Файл успешно удален
                    header('Location: profile.php'); // Перенаправляем пользователя на страницу профиля
                    exit();
                } else {
                    echo "Ошибка при удалении файла из базы данных: " . $stmt_delete->error;
                }
                $stmt_delete->close();
            } else {
                echo "Ошибка при подготовке запроса для удаления файла: " . $connect->error;
            }
        } else {
            echo "Файл не найден.";
        }

        $stmt->close();
    } else {
        echo "Ошибка при подготовке запроса: " . $connect->error;
    }
} else {
    header('Location: profile.php'); // Если параметр file_id не передан, перенаправляем на страницу профиля пользователя
    exit();
}

$connect->close();
?>
