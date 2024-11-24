<?php
function connect_to_db(): PDO
{
    $host = "localhost";
    $dbname = "group1";
    $bdd_username = "root";
    $bdd_password = "";
    try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $bdd_username, $bdd_password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Error : ' . $e->getMessage());
    }
}
