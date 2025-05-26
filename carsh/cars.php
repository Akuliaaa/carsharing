<?php 
include 'includes/header.php';
require 'includes/config.php';

$sql = "SELECT * FROM cars WHERE available = 1";
$result = $conn->query($sql);
?>

<main class="container">
  <h2>Наш автопарк</h2>
  
  <div class="filter-bar">
    <select id="filter-price">
      <option value="9999">Любая цена</option>
      <option value="1500">До 1500₽/час</option>
      <option value="2500">До 2500₽/час</option>
    </select>
  </div>

  <div class="cars-grid">
    <?php while($car = $result->fetch_assoc()): ?>
    <div class="car-card" data-price="<?= $car['price'] ?>">
      <img src="assets/images/cars/<?= $car['image'] ?>" alt="<?= $car['model'] ?>">
      <h3><?= $car['model'] ?></h3>
      <p class="price"><?= $car['price'] ?> ₽/час</p>
      <a href="rent.php?id=<?= $car['id'] ?>" class="btn">Арендовать</a>
    </div>
    <?php endwhile; ?>
  </div>
</main>

<?php include 'includes/footer.php'; ?>