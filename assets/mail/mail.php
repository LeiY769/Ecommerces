<?php
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Valider les champs du formulaire
    if (empty($name) || empty($subject) || empty($email) || empty($phone) || empty($message)) {
        // Rediriger vers une page d'erreur si des champs sont vides
        header("Location: ../../mail-error.html");
        exit();
    }

    // Construire le message de l'email
    $email_message = "
    Name: $name
    Subject: $subject
    Email: $email
    Phone: $phone
    Message: $message
    ";

    // Envoyer l'email
    $to = "example@gmail.com"; // Remplacez par votre adresse email
    $headers = "From: $email";

    if (mail($to, "New Message: $subject", $email_message, $headers)) {
        // Rediriger vers une page de succès si l'email est envoyé
        header("Location: ../../mail-success.html");
    } else {
        // Rediriger vers une page d'erreur si l'email n'est pas envoyé
        header("Location: ../../mail-error.html");
    }
    exit();
} else {
    // Rediriger vers la page de contact si la méthode de requête n'est pas POST
    header("Location: ../../contact_page.php");
    exit();
}
    */
// Rediriger vers la page de contact si la méthode de requête n'est pas POST
header("Location: ../../contact_page.php");
exit();
?>