<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = 'root'; // Замени на свой пароль
$dbname = 'jetcarsh';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($pass, $admin['password'])) {
            $_SESSION['admin'] = $admin;
            header("Location: admin_panel.php");
            exit();
        } else {
            $message = "Неверный пароль.";
        }
    } else {
        $message = "Администратор не найден.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Админ вход | JetCarsh</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<header>
  <div class="container">
    <h1 class="logo">JetCarsh</h1>
  </div>
</header>
<main class="container" style="padding: 60px 0; max-width: 400px;">
  <h2 style="color: #e60000; text-align: center;">Вход в админку</h2>
  <?php if ($message): ?>
    <p style="color: red; text-align:center;"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>
  <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
    <input type="text" name="username" placeholder="Логин" required style="padding: 10px; border-radius: 6px; border: none;" />
    <input type="password" name="password" placeholder="Пароль" required style="padding: 10px; border-radius: 6px; border: none;" />
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
