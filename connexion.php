<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST["email"])); 
    $mot_de_passe = $_POST["password"];

    try {
     
        echo "Email saisi : " . htmlspecialchars($email) . "<br>";
        echo "Mot de passe saisi : " . htmlspecialchars($mot_de_passe) . "<br>";

       
        $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch();

        if (!$utilisateur) {
            $_SESSION['error'] = "Aucun utilisateur trouvé avec l’email : " . htmlspecialchars($email);
            header("Location: page2.php");
            exit();
        }

      
        echo "Email dans la base : " . htmlspecialchars($utilisateur['Email']) . "<br>";
        echo "Mot de passe haché dans la base : " . $utilisateur['Mot_passe'] . "<br>";

      
        $verif_mot_de_passe = password_verify($mot_de_passe, $utilisateur["Mot_passe"]);
        echo "Résultat de password_verify : " . ($verif_mot_de_passe ? "Vrai" : "Faux") . "<br>";

        if ($verif_mot_de_passe) {
            $_SESSION['message'] = "Connexion réussie !";
            $_SESSION['client_id'] = $utilisateur['ID_utilisateur'];
            header("Location: dashboard.php");
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