<?php
function connect_to_db(): PDO
{
    $config = parse_ini_file("config.ini");
    $host = $config['host'];
    $dbname = $config['name'];
    $bdd_username = $config['user'];
    $bdd_password = $config['pass'];
    try {
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $bdd_username, $bdd_password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
}

function get_all_products_db(){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT * FROM Product");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_categories_db(){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT DISTINCT category FROM Product");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_products_filtered_db($conditions_sql, $params){
    $conn = connect_to_db();
    $total_products_stmt = $conn->prepare("SELECT COUNT(*) FROM Product $conditions_sql");
    $total_products_stmt->execute($params);
    return $total_products_stmt->fetchColumn();
}

function get_products_filtered_paged_db($conditions_sql, $products_per_page, $offset, $params){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT * FROM Product $conditions_sql LIMIT $products_per_page OFFSET $offset");
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user_from_user_name_db($username){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT * FROM customer WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $tuple = $stmt->fetch();
    return $tuple;
}

function user_exists_db($username){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT * FROM Customer WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->rowCount() != 0;
}

function create_user_db($username, $hashed_password, $first_name, $last_name, $email){
    $conn = connect_to_db();
    $stmt = $conn->prepare("INSERT INTO Customer (username, password, first_name, last_name, email) VALUES (:username, :password, :first_name, :last_name, :email)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    return $stmt->execute();
}

function get_promotions(){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT * FROM Product WHERE discount_price IS NOT NULL");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_max_order_id(){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT MAX(order_id) FROM Orders");
    $stmt->execute();
    return $stmt->fetchColumn();
}

function create_order_table($order_id,$customer_id, $current_date){
    $conn = connect_to_db();
    $stmt = $conn->prepare("INSERT INTO Orders (order_id,customer_id, order_date) VALUES (:order_id,:customer_id, :order_date)");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':order_date', $current_date);
    return $stmt->execute();
}


function get_product_quantity($product_id){
    $conn = connect_to_db();
    $stmt = $conn->prepare("SELECT stock FROM Product WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function remove_product($product, $quantity){
    $conn = connect_to_db();
    $stmt = $conn->prepare("UPDATE Product SET stock = stock - :quantity WHERE product_id = :product_id");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':product_id', $product['product_id']);
    return $stmt->execute();
}

function create_order_detail($order,$product_id, $quantity){
    $conn = connect_to_db();
    $stmt = $conn->prepare("INSERT INTO Order_detail (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
    $stmt->bindParam(':order_id', $order);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
}


?>