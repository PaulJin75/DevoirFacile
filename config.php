<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "devoirfacile"; // Remplace par le nom de ta base de données

$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}
?>
