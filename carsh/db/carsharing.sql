CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `available` tinyint(1) DEFAULT 1,
  `description` text,
  `seats` int(11) DEFAULT 5,
  `transmission` enum('automatic','manual') DEFAULT 'automatic',
  PRIMARY KEY (`id`)
);

INSERT INTO `cars` VALUES
(1,'Toyota Camry',1500.00,'camry.jpg',1,'Комфортный седан',5,'automatic'),
(2,'BMW X5',3000.00,'x5.jpg',1,'Премиальный внедорожник',5,'automatic'),
(3,'Tesla Model 3',2500.00,'tesla.jpg',1,'Электромобиль',5,'automatic');