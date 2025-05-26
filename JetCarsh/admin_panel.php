<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$host = 'localhost';
$user = 'root';
$password = 'root'; // Замени на свой пароль
$dbname = 'jetcarsh';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Удаление пользователя
if (isset($_GET['delete_user'])) {
    $id = (int)$_GET['delete_user'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: admin_panel.php");
    exit();
}

// Получаем список пользователей
$result = $conn->query("SELECT id, name, email, created_at FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Админ панель | JetCarsh</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<header>
  <div class="container">
    <h1 class="logo">JetCarsh Admin</h1>
    <nav>
      <ul>
        <li><a href="admin_panel.php">Пользователи</a></li>
        <li><a href="admin_logout.php">Выйти</a></li>
      </ul>
    </nav>
  </div>
</header>
<main class="container" style="padding: 60px 0;">
  <h2 style="color: #e60000;">Список пользователей</h2>
  <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead style="background-color: #e60000; color: #fff;">
      <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Дата регистрации</th>
        <th>Действия</th>
      </tr>
    </thead>
    <tbody>
      <?php while($user = $result->fetch_assoc()): ?>
      <tr style="border-bottom: 1px solid #ddd;">
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $user['created_at'] ?></td>
        <td>
          <a href="admin_panel.php?delete_user=<?= $user['id'] ?>" onclick="return confirm('Удалить пользователя?');" style="color: #e60000;">Удалить</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>
<footer>
  <div class="container">
    <p>&copy; 2025 JetCarsh. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
