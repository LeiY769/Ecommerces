<?php
require_once 'session.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItems = [];
    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'quantity_')) {
            $productId = str_replace('quantity_', '', $key);
            if($value <= 0){
                header('Location: ../order_page.php?error=Quantities can not be negative or null.');
                exit;
            }
            if(!product_exists_db($productId)){
                header('Location: ../order_page.php?error=Product '.$productId.' unknown');
                exit;
            }
            $availableQtt = get_product_quantity($productId);
            if($availableQtt < $value){
                $productName = product_name_db($productId);
                header('Location: ../order_page.php?error=Not enough stock for "'. $productName .'", must be smaller or equal to : '.$availableQtt);
                exit;
            }
            $cartItems[] = [
                'product_id' => $productId,
                'quantity' => $value
            ];
        }
    }
    if(empty($cartItems)){
        header('Location: ../order_page.php?error=Your order is empty😥');
        exit;
    }
    $newOrderId = get_max_order_id()+1;
    $customerId = get_user_from_user_name_db($_SESSION['username'])["customer_id"];
    $timestamp = date('Y-m-d H:i:s');
    create_order_db($newOrderId, $customerId, $timestamp);
    foreach($cartItems as $product => $data){
        print_r($data);
        remove_product($data["product_id"], $data["quantity"]);
        create_order_detail($newOrderId, $data["product_id"], $data["quantity"]);
    }
    clear_cart();
    header('Location: ../checkout_page.php');
    exit;
}

?>