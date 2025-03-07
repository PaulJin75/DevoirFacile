<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
        $_SESSION['message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: page2.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        header("Location: page2.php");
        exit();
    }
}
?>