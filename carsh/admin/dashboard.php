<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Управление автомобилями</h1>
    <table>
        <tr>
            <th>Модель</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        <?php
        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['model']}</td>
                <td>{$row['price']} ₽</td>
                <td><a href='edit.php?id={$row['id']}'>Редактировать</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>