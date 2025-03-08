<?php
// Définition des constantes   
define("local_serveur", "localhost");
define("local_username", "root");
define("local_password", "");
define("local_base", "devoirfacile");

// Connexion à la base de données avec MySQLi
$ma_connexion = mysqli_connect(local_serveur, local_username, local_password, local_base);

// Vérifier la connexion
if (!$ma_connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>
