DROP DATABASE IF EXISTS group1;

SET time_zone = "+00:00";
CREATE DATABASE group1;

USE group1;

CREATE TABLE IF NOT EXISTS `Customer`(
    `customer_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(30) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30) NOT NULL,
    `email` VARCHAR(60) NOT NULL
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Product` (
    `product_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `category` VARCHAR(30) NOT NULL,
    `image` VARCHAR(255) NOT NULL, 
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity_in_stock` INT NOT NULL,
    `discount_price` DECIMAL(10, 2) DEFAULT NULL
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Order_table`(
    `order_id` BIGINT PRIMARY KEY,
    `customer_id` BIGINT NOT NULL,
    `order_date` DATETIME NOT NULL,
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


INSERT INTO `Product`(`name`, `category`, `image`, `price`, `quantity_in_stock`, `discount_price`) VALUES
('Chocolate bread', 'breakfast', 'assets/images/products/breakfast/chocolate_bread.jpg', '1.4', '500', NULL),
('Croissant', 'breakfast', 'assets/images/products/breakfast/croissant.jpg', '1.0', '400', NULL),
('Chocolate mousse', 'dessert', 'assets/images/products/dessert/chocolate_mousse.jpg', '2.3', '200', '1.99'),
('Tiramisu', 'dessert', 'assets/images/products/dessert/tiramisu.jpg', '2.5', '300', NULL),
('Coca-cola', 'drinks', 'assets/images/products/drinks/coca.jpg', '2.', '200', NULL),
('Coffee', 'drinks','assets/images/products/drinks/cafe.jpg','1.8', '150', NULL),
('Ice tea', 'drinks', 'assets/images/products/drinks/ice_tea.jpg', '1.8', '100', NULL),
('Orange juice', 'drinks', 'assets/images/products/drinks/orange_juice.jpg', '1.5', '200', NULL),
('Water', 'drinks', 'assets/images/products/drinks/water.jpg', '1.0','500', NULL),
('Apple', 'fruits', 'assets/images/products/fruits/apple.jpg', '1.1', '300', NULL),
('Pear', 'fruits', 'assets/images/products/fruits/pear.jpg', '1.1', '100', NULL),
('Clementine', 'fruits', 'assets/images/products/fruits/clementine.jpg', '0.8', '200', NULL),
('Kiwi', 'fruits', 'assets/images/products/fruits/kiwi.jpg', '1.7', '200', '1.5'),
('Orange', 'fruits', 'assets/images/products/fruits/orange.jpg', '1.4', '80', NULL),
('Banana', 'fruits', 'assets/images/products/fruits/banana.jpg', '1.6', '200', NULL),
('Meatballs with rabbit sauce', 'lunch', 'assets/images/products/lunch/boulette.jpg', '4', '200', NULL),
('Daily meal', 'lunch', 'assets/images/products/lunch/daymeal.jpg', '4', '500', NULL),
('Spaghetti bolognese', 'lunch', 'assets/images/products/lunch/pasta.jpg', '3.5', '200', NULL),
('Vol-au-vent', 'lunch', 'assets/images/products/lunch/vol_au_vent.jpg', '4.5', '200', '3.99'),
('Daily Salad', 'lunch', 'assets/images/products/lunch/salad.jpg', '3.25', '200', NULL),
('Daily Soup', 'lunch', 'assets/images/products/lunch/soup.jpg', '1.99', '600', NULL),
('Sandwich', 'lunch', 'assets/images/products/lunch/sandwich.jpg', '2.99', '300', NULL),
('Biscuit', 'snacks', 'assets/images/products/snacks/leo.jpg', '2.01', '200', NULL),
('Waffel', 'snacks', 'assets/images/products/snacks/waffel.jpg','2.5', '300', NULL),
('Candy', 'snacks', 'assets/images/products/snacks/sweet.jpg', '1.99', '200', NULL),
('Lobster', 'lunch', 'assets/images/products/lunch/lobster.jpg', '13.99', '50', NULL),
('Salad of salmon', 'lunch', 'assets/images/products/lunch/salmon.jpg', '8.99', '80', NULL);

INSERT INTO `Customer`(`username`, `password`, `first_name`, `last_name`, `email`) VALUES
('michel', '123', 'Michel', 'Dupont', 'michel@gmail.com');

INSERT INTO `Order_table`(`order_id`,`customer_id`, `order_date`) VALUES
('1','1', '2015-03-20 12:00:00');

INSERT INTO `Delivery`(`name`, `phone_number`) VALUES
('Jean', '0478/12.34.56'),
('Pierre', '0478/12.34.57'),
('Paul', '0478/12.34.58'),
('Jacques', '0478/12.34.59');

INSERT INTO `Delivery_by`(`order_id`, `person_id`) VALUES
('1', '1');

INSERT INTO `Order_detail`(`order_id`, `product_id`, `quantity`) VALUES
('1', '1', '2'),
('1', '2', '3'),
('1', '3', '1'),
('1', '4', '1'),
('1', '5', '2'),
('1', '6', '1'),
('1', '7', '1'),
('1', '8', '1'),
('1', '9', '2'),
('1', '10', '3'),
('1', '11', '1'),
('1', '12', '2'),
('1', '13', '1'),
('1', '14', '1'),
('1', '15', '1'),
('1', '16', '2'),
('1', '17', '1'),
('1', '18', '1'),
('1', '19', '1'),
('1', '20', '1'),
('1', '21', '1'),
('1', '22', '1'),
('1', '23', '1'),
('1', '24', '1'),
('1', '25', '1');