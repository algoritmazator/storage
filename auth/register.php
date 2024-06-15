<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <title>Главная</title>
</head>
<body>
  <header>
    <div class="logo">
      <a href="../index.html">CLOUD DRIVE</a></div>
    </div>
    <nav>
      <a href="../about.php">О сервисе</a>
      <a href="support.php">Поддержка</a>
    </nav>
  </header>
  <section>
    <a href="index.php" class="supporrt_a"><button class="support_but">&#10229;</button></a>
    <article class="support_block_7">
      <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label>ФИО</label><br>
        <input type="text" name="full_name" placeholder="Введите свое полное имя"><br>
        <label>Логин</label><br>
        <input type="text" name="login" placeholder="Введите свой логин"><br>
        <label>Почта</label><br>
        <input type="email" name="email" placeholder="Введите адрес своей почты"><br>
        <label>Изображение профиля</label><br>
        <input type="file" name="avatar"><br>
        <label>Пароль</label><br>
        <input type="password" name="password" placeholder="Введите пароль"><br>
        <label>Подтверждение пароля</label><br>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль"><br>
        <button type="submit">Войти</button><br>
        <p>
            У вас уже есть аккаунт? - <a href="index.php">авторизируйтесь</a>!
        </p>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
    ?>
    </form>
    </article>

    </form>
  </section>
  <footer>
    <div class="logo">CLOUD DRIVE</div>
    <div class="support_block_5">
      <div class="column">
        <p class="txt_2">Страницы</p>
        <a href="about.html">О сервисе</a><br>
      <a href="funk.html">Решения</a><br>
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
</body>
</html>