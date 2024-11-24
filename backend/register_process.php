<?php
require_once 'utility.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $fore_name = $_POST['fore_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if ($password !== $password_confirm) {
        $error = "Passwords do not match.";
        header("Location: ../register.php?error=" . urlencode($error));
        exit();
    }

    // Connect to the database
    $conn = connect_to_db();

    // Check if the username is unique
    $stmt = $conn->prepare("SELECT * FROM Customer WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error = "Username is already taken.";
        header("Location: ../register.php?error=" . urlencode($error));
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO Customer (username, password, fore_name, last_name, email) VALUES (:username, :password, :fore_name, :last_name, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':fore_name', $fore_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            header("Location: ../login.php");
            exit();
        } else {
            $error = "An error occurred. Please try again.";
            header("Location: ../register.php?error=" . urlencode($error));
            exit();
        }
    }
}
