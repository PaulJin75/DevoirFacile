<?php
define("LOCAL_SERVEUR", "localhost");
define("LOCAL_USERNAME", "root");
define("LOCAL_PASSWORD", "");
define("LOCAL_BASE", "devoirfacile");

try {
    $pdo = new PDO(
        "mysql:host=" . LOCAL_SERVEUR . ";dbname=" . LOCAL_BASE,
        LOCAL_USERNAME,
        LOCAL_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>