<?php
// Adresse de destination (la tienne)
$to = "salioussama213@gmail.com";

// Récupération des données du formulaire
$from_email = isset($_POST['from_email']) ? trim($_POST['from_email']) : "";
$subject    = isset($_POST['subject']) ? trim($_POST['subject']) : "";
$message    = isset($_POST['message']) ? trim($_POST['message']) : "";

// Vérification minimale
if ($from_email === "" || $subject === "" || $message === "") {
    $msg = urlencode("Veuillez remplir tous les champs du formulaire.");
    header("Location: index.php?status=error&msg=" . $msg . "#contact");
    exit;
}

// Construction du contenu de l'e-mail
$body  = "Vous avez reçu un nouveau message depuis le portfolio de Oussama Sali.\n\n";
$body .= "De : " . $from_email . "\n";
$body .= "Objet : " . $subject . "\n\n";
$body .= "Message :\n" . $message . "\n";

// En-têtes de l'e-mail
$headers  = "From: " . $from_email . "\r\n";
$headers .= "Reply-To: " . $from_email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Tentative d'envoi
if (mail($to, "Portfolio - " . $subject, $body, $headers)) {
    $msg = urlencode("Votre message a été envoyé avec succès. Merci de m'avoir contacté.");
    header("Location: index.php?status=success&msg=" . $msg . "#contact");
    exit;
} else {
    $msg = urlencode("Le message n'a pas pu être envoyé. Veuillez réessayer plus tard.");
    header("Location: index.php?status=error&msg=" . $msg . "#contact");
    exit;
}