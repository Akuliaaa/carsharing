<?php
$conn = new mysqli('localhost', 'root', '', 'carsharing');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>