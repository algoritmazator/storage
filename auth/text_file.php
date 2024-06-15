<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
require_once 'vendor/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <title>text_files</title>
</head>
<body>
  <header>
    <div class="logo">
      <a href="../index.php">CLOUD DRIVE</a></div>
    </div>
    <nav>
      <a href="../about.html">О сервисе</a>
      <a href="../funk.html">Решения</a>
      <a href="../support.html">Поддержка</a>
    </nav>
    <div id="support_header">
    <a href="#">
      <div class="support_header_img">
        <img src="../img/setting_2040504.png">
      </div>
      </a>
      <a href="#" >
        <button class="show" id="show">
        <div class="support_header_img">
          <img src="../img/profile-user_5415419.png">
</button>
</a>
          <dialog>
          <form class="form_dialog" >
          <button type="button" class="close" id="close">&#215;</button><br>
            <img src="<?= $_SESSION['user']['avatar'] ?>" width="200" alt="">
            <h2 ><?= $_SESSION['user']['full_name'] ?></h2><br>
            <a href="#"><?= $_SESSION['user']['email'] ?></a><br>
            
            <a href="vendor/logout.php" class="logout">Выход</a><br>
            
        </form>
        </dialog>
        </div>
        
      
    </div>
  </header>
<main>
  <aside>
  <form action="uploads.php" method="POST" style="background: none; padding: 0; margin: 0;" id="uploadForm" enctype="multipart/form-data">
    <input id="fileInput" type="file" name="file[]" multiple style="display: none;">
    <button type="button" id="chooseFilesBtn" onclick="document.getElementById('fileInput').click()">Загрузить &#10515;</button>
</form>

<script>
document.getElementById('fileInput').addEventListener('change', function() {
    // После выбора файла отправляем форму
    document.getElementById('uploadForm').submit();
});
</script>
<a href="profile.php" class="sup_aside_a_1">
      <div class="support_aside_img">
      <img src="../img/free-icon-home-1946436.png">
      </div>
      Главная
    </a><br>
<a href="last_files.php" class="sup_aside_a_1">
      <div class="support_aside_img">
      <img src="../img/free-icon-three-o-clock-clock-13435.png">
      </div>
      Последнее
    </a><br>
    <a href="text_file.php" class="sup_aside_a_1">
      <div class="support_aside_img">
      <img src="../img/free-icon-open-file-4847498.png">
      </div>Файлы
    </a><br>
    <a href="image_file.php" class="sup_aside_a_1">
      <div class="support_aside_img">
      <img src="../img/free-icon-image-gallery-3342176.png">
      </div>
      Фото
    </a><br>
  </aside>
  
  <section id="section_file" style="background-color: white;">
  <?php
$user_id = $_SESSION['user']['id'];
$select_query = "SELECT * FROM `file` WHERE `user_id` = ? AND (`filetype` = 'application/pdf' OR `filetype` = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' OR `filetype` = 'text/plain')";

if ($stmt = $connect->prepare($select_query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Отображение загруженных текстовых файлов
    while ($row = $result->fetch_assoc()) {
        echo '<div id="support_file">';
            
        // Получаем путь к файлу на сервере
        $filepath = '../uploads/' . $row['filename']; // Путь к файлу на сервере

        // Определяем тип файла и отображаем соответствующий элемент
        $file_extension = pathinfo($row['filename'], PATHINFO_EXTENSION);
        if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Отображаем изображение
            echo '<img src="' . $filepath . '" alt="' . $row['filename'] . '">';
        } elseif (in_array($file_extension, ['pdf', 'docx', 'rar'])) {
            // Отображаем иконку файла
            echo '<img src="../img/' . $file_extension . '.png" alt="' . $row['filename'] . '">';
        }

        // Выводим информацию о файле
        echo '<p>' . $row['filename'] . '</p>';
        echo '<p>' . $row['filetype'] . '</p>';
        echo '<p>' . $row['filesize'] . ' байт</p>';
        
        // Добавляем ссылку для скачивания файла
        echo '<form id="form_uploads" method="get" action="vendor/download.php">';
        echo '<input type="hidden" name="file_id" value="' . $row['id'] . '">';
        echo '<button id="btn_uploads" type="submit">Скачать</button>';
        echo '</form>';
        
        // Добавляем кнопку для удаления файла
        echo '<form id="form_delite_file" method="post" action="delite_file.php">';
        echo '<input type="hidden" name="file_id" value="' . $row['id'] . '">';
        echo '<button id ="btn_delite_file" type="submit">Удалить</button>';
        echo '</form>';

        echo '</div>';
    }
    $stmt->close();
} else {
    echo "Ошибка при подготовке запроса: " . $connect->error;
    exit(); // Прерываем выполнение скрипта при возникновении ошибки
}

// Закрываем соединение с базой данных
$connect->close();
?>
</section>



</main>
  <footer>
    <div class="logo">CLOUD DRIVE</div>
    <div class="support_block_5">
      <div class="column">
        <p class="txt_2">Страницы</p>
        <a href="about.html">О сервисе</a><br>
      <a href="funk.html"><span class="sup_a">Решения</span></a><br>
      <a href="index.html">Вход</a><br>
       <a href="support.html">Поддержка</a><br>
       <a href="../index.html">Главная</a>
      </div>
      <div class="column">
        <p class="txt_2">Контакты</p>
        <p>+7(800)-555-35-35</p>
        <p>cloudrive@gmail.com</p>
      </div>
    </div>
    <br>
    
   <div class="seti">
      <p class="sup_txt">Мы в соцсетях</p>
      <div class="sup_block_seti">
        <div class="sup_block_6">
        <img src="../img/free-icon-telegram-2111710.webp"><p>Телеграм</p>
        </div>
        <div class="sup_block_6">
        <img src="../img/free-icon-vk-5969029.webp"><p>ВКонтакте</p>
        </div>
        <div class="sup_block_6">
        <img src="../img/free-icon-youtube-4494467.webp"><p>YouTube</p>
        </div>
      </div>
    </div>
    
    <div class="prava">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
        Illo odit aliquid soluta unde libero ducimus veritatis at iure eligendi a consectetur eos dicta et, facere magni odio aspernatur tenetur similique. Права не защищены.</p>
    </div>

  </footer>
  <script src="../script/script2.js"></script>
</body>

</html>