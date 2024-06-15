<?php
session_start();
// if (!$_SESSION['user']) {
//     header('Location: /');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Главная</title>
</head>
<body>
<header>
  <div class="logo">
    <a href="index.php">CLOUD DRIVE</a>
  </div>
  <nav>
    <a href="../about.php">О сервисе</a>
      <a href="support.php">Поддержка</a>
    <a href="admin/index.php">Я администратор</a>
  </nav>
<?php
    // Проверяем, авторизован ли пользователь
    if (isset($_SESSION['user'])) {
  ?>
    <a class="support_a2" href="#" >
      <button class="show" id="show">
        <div class="support_header_img">
          <img src="img/profile-user_5415419.webp">
        </div>
      </button>
    </a>
    <dialog>
      <form class="form_dialog">
      <button type="button" class="close" id="close">&#215;</button><br>
      <img src="auth/<?php echo $_SESSION['user']['avatar']; ?>" width="200" alt="">
        <h2><?= $_SESSION['user']['full_name'] ?></h2><br>
        <a href="#"><?= $_SESSION['user']['email'] ?></a><br>
        
        <a href="auth/profile.php" class="logout">В личный кабинет</a><br>
        <a href="auth/vendor/logout.php" class="logout">Выход</a><br>
      </form>
    </dialog>

  <?php
    } else {
  ?>
    <a class="support_a" href="auth/index.php"><button>Войти</button></a>
  <?php
    }
  ?>
</header>
<section>
    <article id="support_about">
        <div id="about_text">
            <p><b>CLOUD DRIVE - </b>сервис для хранения файлов. Вы можете загружать изображения и текстовые файлы в
            формате docx и pdf.</p>\
            <div id="support_ab">
                <ul>
                    <li>Доступ к файлам с любого устройства</li>
                    <li>Безопасное хранение</li>
                    <li>Удобная обратная связь</li>
                </ul>
                <div class="image_about">
                    <img src="img/Слой 1.webp">
                </div>
            </div>
        </div>
        <a href="auth/index.php"><button>Начать пользоваться</button></a>
    </article>
</section>
<footer>
    <div class="logo">CLOUD DRIVE</div>
    <div class="support_block_5">
      <div class="column">
        <p class="txt_2">Страницы</p>
        <a href="about.html">О сервисе</a><br>
      <a href="">Вход</a>
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
        <img src="img/free-icon-telegram-2111710.webp"><p>Телеграм</p>
        </div>
        <div class="sup_block_6">
          <img src="img/free-icon-vk-5969029.webp"><p>ВКонтакте</p>
        </div>
        <div class="sup_block_6">
        <img src="img/free-icon-youtube-4494467.webp"><p>YouTube</p>
        </div>
      </div>
    </div>
    
    <div class="prava">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
        Illo odit aliquid soluta unde libero ducimus veritatis at iure eligendi a consectetur eos dicta et, facere magni odio aspernatur tenetur similique. Права не защищены.</p>
    </div>
<script src="script/script2.js"></script>
  </footer>
</body>
</html>