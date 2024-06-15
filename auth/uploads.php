<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

require_once 'vendor/connect.php';

$uploadDirectory = '../uploads/';

if (isset($_FILES['file'])) {
    $user_id = $_SESSION['user']['id'];

    $file_count = count($_FILES['file']['name']);

    for ($i = 0; $i < $file_count; $i++) {
        $filename = $_FILES['file']['name'][$i];
        $filetype = $_FILES['file']['type'][$i];
        $filesize = $_FILES['file']['size'][$i];
        $tempFilePath = $_FILES['file']['tmp_name'][$i];
        
        $uploadFilePath = $uploadDirectory . $filename;

        if (move_uploaded_file($tempFilePath, $uploadFilePath)) {
            // Открываем файл и считываем его содержимое
            $filecontent = file_get_contents($uploadFilePath);

            $insert_query = "INSERT INTO `file` (`filename`, `filetype`, `filesize`, `filecontent`, `user_id`) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $connect->prepare($insert_query)) {
                $stmt->bind_param("ssisi", $filename, $filetype, $filesize, $filecontent, $user_id);
                
                if ($stmt->execute()) {
                    // Файл успешно загружен и записан в базу данных
                } else {
                    echo "Ошибка при загрузке файла в базу данных: " . $stmt->error;
                    exit(); // Прерываем выполнение скрипта при возникновении ошибки
                }
                $stmt->close();
            } else {
                echo "Ошибка при подготовке запроса: " . $connect->error;
                exit(); // Прерываем выполнение скрипта при возникновении ошибки
            }
        } else {
            echo "Ошибка при перемещении файла в папку загрузки.";
            exit();
        }
    }
    header('Location: profile.php');
}

$connect->close();
?>
