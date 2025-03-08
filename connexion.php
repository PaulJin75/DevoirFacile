<?php
require 'config.php';  // Inclusion du fichier de connexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        echo "Connexion réussie !";
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>
