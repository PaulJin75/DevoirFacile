<?php
// Définition des constantes
define("LOCAL_SERVEUR", "localhost");
define("LOCAL_USERNAME", "root");
define("LOCAL_PASSWORD", "");
define("LOCAL_BASE", "devoirfacile");

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO(
        "mysql:host=" . LOCAL_SERVEUR . ";dbname=" . LOCAL_BASE . ";charset=utf8",
        LOCAL_USERNAME,
        LOCAL_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions pour les erreurs
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Retourner les résultats sous forme de tableau associatif
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>