<?php
include 'includes/config.php';
include 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO orders (car_id, name, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $car_id, $name, $phone);
    $stmt->execute();

    header("Location: cars.php?success=1");
    exit();
}
?>