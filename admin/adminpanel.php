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
    <nav>
<a href="support_user.php">Обращения пользователей</a>
</nav>
  </header>
  <section id="adminpanel">
  <?php
session_start();
require_once '../auth/vendor/connect.php';
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$sql = "SELECT id, full_name, login, email, last_login, blocked FROM users";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Login</th><th>Email</th><th>Last Login</th><th>Status</th><th>Action</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["login"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["last_login"] . "</td>";
        echo "<td>" . ($row["blocked"] ? "Заблокирован" : "Активен") . "</td>";
        echo "<td><a href='delite_user.php?id=" . $row["id"] . "'>Удалить</a> | ";
        echo "<a href='block_user.php?id=" . $row["id"] . "&action=" . ($row["blocked"] ? "unblock" : "block") . "'>";
        echo ($row["blocked"] ? "Разблокировать" : "Заблокировать") . "</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$connect->close();
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