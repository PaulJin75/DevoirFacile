<?php
require 'config.php';  // Inclusion du fichier de connexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Préparer la requête SQL avec MySQLi
    $stmt = mysqli_prepare($ma_connexion, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Vérification du mot de passe
    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        echo "Connexion réussie !";
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>
