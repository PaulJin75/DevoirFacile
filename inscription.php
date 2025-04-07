<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['name'];
    $email = strtolower(trim($_POST['email']));
    $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($email === 'jm@devoirfacile.com') {
        $_SESSION['error'] = "Cet email est réservé à l’administrateur.";
        header("Location: page2.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Utilisateurs WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['error'] = "Cet email est déjà utilisé.";
            header("Location: page2.php");
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (Nom, Email, Mot_passe, Est_admin) VALUES (:nom, :email, :mot_de_passe, FALSE)");
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