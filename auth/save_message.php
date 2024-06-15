<?php
// Подключаемся к базе данных
require_once 'vendor/connect.php';

// Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Подготавливаем SQL запрос для сохранения сообщения в базе данных
$sql = "INSERT INTO feedback_messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

// Выполняем запрос
if ($stmt->execute()) {
    $_SESSION['message'] = "Ваше сообщение успешно отправлено.";
} else {
    $_SESSION['message'] = "Ошибка при отправке сообщения.";
}
header('Location: support.php');
// Закрываем соединение с базой данных
$stmt->close();
$connect->close();
?>
