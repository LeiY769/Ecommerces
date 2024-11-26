<?php
include_once "session.php";
$host = "localhost";
$dbname = "group1";
$bdd_username = "root";
$bdd_password = "";
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $bdd_username, $bdd_password);
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Error : ' . $e->getMessage());
}
$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
}
if (!empty($username) && !empty($password)) {

    $req = $bdd->prepare("SELECT * FROM customer WHERE username =?");
    $req->execute(array($username));
    $tuple = $req->fetch();
    $req->closeCursor();
    if ($tuple && password_verify($password, $tuple["password"])) {
        $_SESSION['username'] = $tuple["username"];
        $_SESSION['password'] = $tuple["password"];
        $_SESSION['first_name'] = $tuple["first_name"];
        $_SESSION['last_name'] = $tuple["last_name"];
        $_SESSION['email'] = $tuple["email"];
        $_SESSION['logged_in'] = true;
        header('Location: ../index.php');
    } else
        header('Location: ../login.php?error=1#login_form');
} else {
    header('Location: ../login.php?error=2#login_form');
}