<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST["email"]));
    $mot_de_passe = $_POST["mot_de_passe"];

    try {
        $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch();

        if (!$utilisateur) {
            $_SESSION['error'] = "Aucun utilisateur trouvé avec l’email : " . htmlspecialchars($email);
            header("Location: page2.php");
            exit();
        }

        $mot_de_passe_hache = $utilisateur["Mot_passe"];
        $verif_mot_de_passe = password_verify($mot_de_passe, $mot_de_passe_hache);

        if ($verif_mot_de_passe) {
            $_SESSION['message'] = "Connexion réussie !";
            $_SESSION['client_id'] = $utilisateur['ID_utilisateur'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Mot de passe incorrect pour l’email : " . htmlspecialchars($email);
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