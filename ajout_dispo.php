<?php
session_start();
require_once 'config.php';


if (!isset($_SESSION['client_id'])) {
    header("Location: page2.php");
    exit();
}


$stmt = $pdo->prepare("SELECT Est_admin FROM Utilisateurs WHERE ID_utilisateur = :id");
$stmt->execute(['id' => $_SESSION['client_id']]);
if (!$stmt->fetch()['Est_admin']) {
    header("Location: dashboard.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_heure = $_POST['date_heure'];

    try {
        $stmt = $pdo->prepare("INSERT INTO Disponibilites (Date_heure) VALUES (:date)");
        $stmt->execute(['date' => $date_heure]);
        header("Location: dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>