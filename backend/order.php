<?php
require_once 'session.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItems = [];
    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'quantity_')) {
            $productId = str_replace('quantity_', '', $key);

            $quantity = max(0, intval($value));
            if($quantity <= 0){
                header('Location: ../order_page.php?error=Quantities can not be negative or null.');
            }
        }
    }
}

?>