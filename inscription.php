<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Insérer directement dans Utilisateurs
        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (Nom, Email, Mot_passe) VALUES (:nom, :email, :mot_de_passe)");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe
        ]);

        $_SESSION['message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: page2.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'inscription : " . $e->getMessage();
        header("Location: page2.php");
        exit();
    }
}
?>