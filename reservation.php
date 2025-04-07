<?php
session_start();
require_once 'config.php';


if (!isset($_SESSION['client_id'])) {
    header("Location: page2.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_niveau = $_POST['id_niveau'];
    $id_matiere = $_POST['id_matiere'];
    $id_disponibilite = $_POST['id_disponibilite'];
    $id_client = $_SESSION['client_id'];
    $tarif = 15.00; 

    try {

        $stmt = $pdo->prepare("
            INSERT INTO Cours (Tarif, ID_client, ID_matiere, ID_niveau, ID_disponibilite) 
            VALUES (:tarif, :client, :matiere, :niveau, :dispo)
        ");
        $stmt->execute([
            'tarif' => $tarif,
            'client' => $id_client,
            'matiere' => $id_matiere,
            'niveau' => $id_niveau,
            'dispo' => $id_disponibilite
        ]);

        $id_cours = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO Cours_Etats (ID_cours, ID_etat) 
            VALUES (:cours, (SELECT ID_etat FROM Etats_cours WHERE Libelle_etat = 'En attente'))
        ");
        $stmt->execute(['cours' => $id_cours]);

        header("Location: paypal_paiements.php?cours_id=$id_cours");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>