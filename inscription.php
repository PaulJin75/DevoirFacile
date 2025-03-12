<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Démarrer une transaction pour insérer dans deux tables
        $pdo->beginTransaction();

        // Insérer dans Utilisateurs
        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (Nom, Email) VALUES (:nom, :email)");
        $stmt->execute(['nom' => $nom, 'email' => $email]);
        $id_utilisateur = $pdo->lastInsertId(); // Récupérer l'ID généré

        // Insérer dans Clients
        $stmt = $pdo->prepare("INSERT INTO Clients (Nom, Email, Mot_passe, ID_utilisateurs) VALUES (:nom, :email, :mot_de_passe, :id_utilisateur)");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe,
            'id_utilisateur' => $id_utilisateur
        ]);

        // Valider la transaction
        $pdo->commit();

        $_SESSION['message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: page2.php");
        exit();
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        $_SESSION['error'] = "Erreur lors de l'inscription : " . $e->getMessage();
        header("Location: page2.php");
        exit();
    }
}
?>