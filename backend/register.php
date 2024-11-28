<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if(empty($username) || empty($password) || empty($password_confirm) || empty($first_name) || empty($last_name) || empty($email)){
        $error = "🚨 All fields are mandatory";
        header("Location: ../register_page.php?error=" . urlencode($error));
        exit();
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "🚨 You must provide a valid email address";
        header("Location: ../register_page.php?error=" . urlencode($error));
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
        $error = "🚨 Password is very frequent.";
        header("Location: ../register_page.php?error=" . urlencode($error));
        exit();
    }

    

    if ($password !== $password_confirm) {
        $error = "🚨 Passwords do not match.";
        header("Location: ../register_page.php?error=" . urlencode($error));
        exit();
    }

    if (user_exists_db($username)) {
        $error = "🚨 Username is already taken.";
        header("Location: ../register_page.php?error=" . urlencode($error));
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (create_user_db($username, $hashed_password, $first_name, $last_name, $email)) {
            header("Location: ../login_page.php?success=Account created!🎉 You can now login 🥳");
            exit();
        } else {
            $error = "🚨 An error occurred. Please try again.";
            header("Location: ../register_page.php?error=" . urlencode($error));
            exit();
        }
    }
}
