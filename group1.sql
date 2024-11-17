DROP DATABASE IF EXISTS group1;

SET time_zone = "+00:00";
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
    `position` VARCHAR(100) NOT NULL,

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

INSERT INTO `Customer`(`username`, `password`, `fore_name`, `last_name`, `email`) VALUES
('michel', '123', 'Michel', 'Dupont', 'michel@gmail.com');

INSERT INTO `Order_table`(`customer_id`, `order_date`, `order_time`, `position`) VALUES
('1', '2015-03-20', '12:30:00', 'Rue de la gare 12, 1000 Bruxelles');

INSERT INTO `Delivery`(`name`, `phone_number`) VALUES
('Jean', '0478/12.34.56'),
('Pierre', '0478/12.34.57'),
('Paul', '0478/12.34.58'),
('Jacques', '0478/12.34.59');

INSERT INTO `Delivery_by`(`order_id`, `person_id`) VALUES
('1', '1'),
;

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








