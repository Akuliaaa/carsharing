<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Профиль | JetCarsh</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <div class="container">
    <h1 class="logo">JetCarsh</h1>
    <nav>
      <ul>
        <li><a href="index.html">Главная</a></li>
        <li><a href="about.html">О нас</a></li>
        <li><a href="cars.html">Авто</a></li>
        <li><a href="contacts.html">Контакты</a></li>
        <li><a href="logout.php">Выйти</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="container" style="padding: 60px 0;">
  <h2 style="color: #e60000; text-align: center;">Личный кабинет</h2>
  <div style="max-width: 600px; margin: 0 auto;">
    <p><strong>Имя:</strong> <?= htmlspecialchars($user['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Дата регистрации:</strong> <?= $user['created_at'] ?></p>
    <a href="logout.php" class="btn">Выйти из аккаунта</a>
  </div>
</main>

<footer>
  <div class="container">
    <p>&copy; 2025 JetCarsh. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
