<?php
    session_start();
    if ($_SESSION['admin']) {
        header('Location: adminpanel.php');
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
     CLOUD DRIVE
    </div>
  </header>
  <section>
    <article class="support_block_8">
    <form id="form_adminpanel" action="signinadmin.php" method="post">
      <label>Логин</label><br>
      <input type="text" name="name" placeholder="Введите свой логин"><br>
      <label>Пароль</label><br>
      <input type="password" name="password" placeholder="Введите пароль"><br>
      <button type="submit">Войти</button>
  </form>
    </article>

    </form>
<?php
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Очищаем сообщение после вывода
}
?>
  </section>
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
</body>
</html>