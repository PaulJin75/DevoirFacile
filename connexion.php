<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    try {
        $stmt = $pdo->prepare("SELECT * FROM Clients WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $client = $stmt->fetch(); // Récupérer une seule ligne

        if ($client && password_verify($mot_de_passe, $client["Mot_passe"])) {
            $_SESSION['message'] = "Connexion réussie !";
            $_SESSION['client_id'] = $client['ID_Clients']; // Stocker l'ID du client
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