<?php
include_once "session.php";
include_once "db.php";

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
}

if (!empty($username) && !empty($password)) {
    $tuple = get_user_from_user_name_db($username);
    if ($tuple && password_verify($password, $tuple["password"])) {
        $_SESSION['username'] = $tuple["username"];
        $_SESSION['password'] = $tuple["password"];
        $_SESSION['first_name'] = $tuple["first_name"];
        $_SESSION['last_name'] = $tuple["last_name"];
        $_SESSION['email'] = $tuple["email"];
        $_SESSION['logged_in'] = true;
        header('Location: ../index.php');
        exit;
    } else
        header('Location: ../login_page.php?error=Wrong password');
        exit;
} else {
    header('Location: ../login_page.php?error=Missing input data');
    exit;
}
?>