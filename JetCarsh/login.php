<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = 'root'; // ← замени при необходимости
$dbname = 'jetcarsh';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: profile.php");
            exit();
        } else {
            $message = "Неверный пароль.";
        }
    } else {
        $message = "Пользователь не найден.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вход | JetCarsh</title>
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
        <li><a href="register.php">Регистрация</a></li>
        <li><a href="login.php">Вход</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="container" style="padding: 60px 0; max-width: 600px;">
  <h2 style="color: #e60000; text-align: center;">Вход в аккаунт</h2>
  <?php if ($message): ?>
    <p style="color: red; text-align:center;"><?= $message ?></p>
  <?php endif; ?>
  <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
    <input type="email" name="email" placeholder="Email" required style="padding: 10px; border-radius: 6px; border: none;">
    <input type="password" name="password" placeholder="Пароль" required style="padding: 10px; border-radius: 6px; border: none;">
    <button type="submit" class="btn">Войти</button>
  </form>
</main>

<footer>
  <div class="container">
    <p>&copy; 2025 JetCarsh. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
