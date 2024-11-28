<?php
session_start();
logout();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])&& isset($_POST['product_image'])) {
    if(!isLoggedIn()){
        echo json_encode(['success' => false, 'error' => 'You must be connected to add something to your order']);
        exit;
    }
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productHasDiscount = $_POST['product_has_discount'];
    if($productHasDiscount){
        $productPrice = $_POST['product_discount'];
    }
    else
        $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => 1
        ];
    }

    echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['getCart'])) {
    if(isLoggedIn()){
        echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
    }
    else{
        echo json_encode(['success' => false, 'cart' => NULL]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    if(isLoggedIn()){
        if ($_SESSION['cart'][$productId]['quantity'] > 1) {
            $_SESSION['cart'][$productId]['quantity']--;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
        echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
    }
    else{
        echo json_encode(['success' => false, 'cart' => NULL]);
    }
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
}

function logout()
{
    if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header('Location: login_page.php');
        exit;
    }
}

function clear_cart(){
    unset($_SESSION['cart']);
}
