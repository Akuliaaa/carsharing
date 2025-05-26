<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = 'admin';
    $password = 'admin123'; // Замените на хеш в реальном проекте

    if ($_POST['login'] === $login && $_POST['password'] === $password) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Неверные данные";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Вход в админку</title>
    <link rel="stylesheet" href="../admin_style.css">
</head>
<body>
    <form method="POST">
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>