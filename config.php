<?php
// Définition des constantes
define("local_serveur", "localhost");
define("local_username", "root");
define("local_password", "");
define("local_base", "devoirfacile");

try {
    $pdo = new PDO("mysql:host=" . local_serveur . ";dbname=" . local_base . ";charset=utf8", local_username, local_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
