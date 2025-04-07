<?php

define("LOCAL_SERVEUR", "localhost");
define("LOCAL_USERNAME", "root");
define("LOCAL_PASSWORD", "motdepassesqlpourroot");
define("LOCAL_BASE", "devoirfacile");

try {
    
    $pdo = new PDO(
        "mysql:host=" . LOCAL_SERVEUR . ";dbname=" . LOCAL_BASE . ";charset=utf8",
        LOCAL_USERNAME,
        LOCAL_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>