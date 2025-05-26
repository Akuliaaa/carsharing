<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'jetcarsh';

$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    if ($action === 'register') {
        $name = $conn->real_escape_string($_POST['name']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql)) {
            $message = "<p style='color:green;'>Регистрация прошла успешно!</p>";
        } else {
            $message = "<p style='color:red;'>Ошибка: " . $conn->error . "</p>";
        }
    } elseif ($action === 'login') {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                header('Location: index.html');
                exit;
            } else {
                $message = "<p style='color:red;'>Неверный пароль</p>";
            }
        } else {
            $message = "<p style='color:red;'>Пользователь не найден</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация / Вход | JetCarsh</title>
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
          <li><a href="register.php">Войти</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container" style="padding: 60px 0; max-width: 600px;">
    <h2 style="color: #e60000; text-align: center;">Регистрация</h2>
    <?php echo $message; ?>
    <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="hidden" name="action" value="register">
      <input type="text" name="name" placeholder="Ваше имя" required style="padding: 10px; border-radius: 6px; border: none;">
      <input type="email" name="email" placeholder="Email" required style="padding: 10px; border-radius: 6px; border: none;">
      <input type="password" name="password" placeholder="Пароль" required style="padding: 10px; border-radius: 6px; border: none;">
      <button type="submit" class="btn">Зарегистрироваться</button>
    </form>

    <h2 style="color: #e60000; text-align: center; margin-top: 50px;">Вход</h2>
    <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="hidden" name="action" value="login">
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
