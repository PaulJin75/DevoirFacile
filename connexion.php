<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['message'] = "Connexion réussie ! Bienvenue, " . $user['name'];
            header("Location: index.php"); // Redirige vers la page d'accueil après connexion
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: page2.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        header("Location: page2.php");
        exit();
    }
}
?>