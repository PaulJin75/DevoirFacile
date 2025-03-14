<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    try {
        $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch(); // Récupérer une seule ligne

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur["Mot_passe"])) {
            $_SESSION['message'] = "Connexion réussie !";
            $_SESSION['client_id'] = $utilisateur['ID_utilisateur']; // Utiliser ID_utilisateur
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: page2.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la connexion : " . $e->getMessage();
        header("Location: page2.php");
        exit();
    }
}
?>