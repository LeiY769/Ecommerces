<?php
session_start();
logout();

function isLoggedIn(): bool
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
}


function logout()
{
    if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
        $_SESSION = array(); // Ecrase tableau de session
        session_unset(); // Detruit toutes les variables de la session en cours
        session_destroy(); // Destruit la session en cours
        header('Location: login.php');
        exit;
    }
}