DROP DATABASE IF EXISTS group1;

CREATE DATABASE group1;

USE group1;

CREATE TABLE IF NOT EXISTS `Customer`(
    `customer_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(30) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `fore_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30) NOT NULL,
    `email` VARCHAR(60) NOT NULL
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Product` (
    `product_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `image` VARCHAR(255) NOT NULL, 
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity_in_stock` INT NOT NULL
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Order_table`(
    `order_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` BIGINT NOT NULL,
    `order_date` DATE NOT NULL,
    `order_time` TIME NOT NULL,
    `position` VARCHAR(30) NOT NULL,

    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Delivery`(
    `person_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `phone_number` VARCHAR(30) NOT NULL,
    `availability`  TINYINT(1) DEFAULT 1
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Delivery_by`(
    `order_id` BIGINT NOT NULL,
    `person_id` BIGINT NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `Order_table`(`order_id`),
    FOREIGN KEY (`person_id`) REFERENCES `delivery`(`person_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Order_detail`(
    `order_id` BIGINT NOT NULL,
    `product_id` BIGINT NOT NULL,
    `quantity` INT NOT NULL,

    FOREIGN KEY (`order_id`) REFERENCES `Order_table`(`order_id`),
    FOREIGN KEY (`product_id`) REFERENCES `Product`(`product_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Ordered_by`(
    `order_id` BIGINT NOT NULL,
    `customer_id` BIGINT NOT NULL,

    FOREIGN KEY (`order_id`) REFERENCES `Order_table`(`order_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;


INSERT INTO `Product`(`name`, `image`, `price`, `quantity_in_stock`) VALUES
('Pain au chocolat', 'photos/breakfast/chocolate_bread.jpg', '1.4', '500'),
('Croissant', 'photos/breakfast/croissant.jpg', '1.0', '400'),
('Mousse au chocolat', 'photos/dessert/chocolate_mousse.jpg', '2.3', '200'),
('Tiramisu', 'photos/dessert/tiramisu.jpg', '2.5', '300'),
('Coca-cola', 'photos/drinks/coca.jpg', '2.', '200'),
('Café','photos/drinks/cafe.jpg','1.8', '150'),
('Ice tea', 'photos/drinks/ice_tea.jpg', '1.8', '100'),
('Jus d`orange', 'photos/drinks/orange_juice.jpg', '1.5', '200'),
('Eau', 'photos/drinks/water.jpg', '1.0','500'),
('Pomme', 'photos/fruits/apple.jpg', '1.1', '300'),
('Poire', 'photos/fruits/pear.jpg', '1.1', '100'),
('Clémentine', 'photos/fruits/clementine.jpg', '0.8', '200'),
('Kiwi', 'photos/fruits/kiwi.jpg', '1.7', '200'),
('Orange', 'photos/fruits/orange.jpg', '1.4', '80'),
('Banane', 'photos/fruits/banana.jpg', '1.6', '200'),
('Boulette Liégeoise', 'photos/lunch/boulette.jpg', '4', '200'),
('Menu du jour', 'photos/lunch/daymeal.jpg', '4', '500'),
('Spaghetti Bolognaise', 'photos/lunch/pasta.jpg', '3.5', '200'),
('Vol au vent', 'photos/lunch/vol_au_vent.jpg', '4.5', '200'),
('Salade du jour', 'photos/lunch/salad.jpg', '3.25', '200'),
('Soupe du jour', 'photos/lunch/soup.jpg', '1.99', '600'),
('Sandwich', 'photos/lunch/sandwich.jpg', '2.99', '300'),
('Leo', 'photos/snacks/leo.jpg', '2.01', '200'),
('Gauffre', 'photos/snacks/waffel.jpg','2.5', '300'),
('Bonbons', 'photos/snacks/sweet.jpg', '1.99', '200');







