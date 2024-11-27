<?php
require_once 'utility.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if(empty($username) || empty($password) || empty($password_confirm) || empty($first_name) || empty($last_name) || empty($email)){
        $error = "All field are mandatory.";
        header("Location: ../register.php?error=" . urlencode($error));
        exit();
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "You must provide a valid email address";
        header("Location: ../register.php?error=" . urlencode($error));
        exit();
    }
    $csv_file = fopen("../sql/common.csv", "r");
    $found = false;
    while (($data = fgetcsv($csv_file)) !== false) {
        if (isset($data[0]) && $data[0] === $password) {
            $found = true;
            break;
        }
    }
    fclose($csv_file);
    if ($found) {
        $error = "Password is not strong enough.";
        header("Location: ../register.php?error=" . urlencode($error));
        exit();
    }

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
        $stmt = $conn->prepare("INSERT INTO Customer (username, password, first_name, last_name, email) VALUES (:username, :password, :first_name, :last_name, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            header("Location: ../login.php?success=Account created!🎉 You can now login 🥳");
            exit();
        } else {
            $error = "An error occurred. Please try again.";
            header("Location: ../register.php?error=" . urlencode($error));
            exit();
        }
    }
}
