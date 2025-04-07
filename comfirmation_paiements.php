<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $cours_id = $data['cours_id'];

    try {
        
        $stmt = $pdo->prepare("
            INSERT INTO Paiements (Date_paiement, Montant) 
            VALUES (NOW(), (SELECT Tarif FROM Cours WHERE ID_cours = :id))
        ");
        $stmt->execute(['id' => $cours_id]);
        $id_paiement = $pdo->lastInsertId();

        
        $stmt = $pdo->prepare("
            INSERT INTO Cours_Paiements (ID_cours, ID_paiement) 
            VALUES (:cours, :paiement)
        ");
        $stmt->execute(['cours' => $cours_id, 'paiement' => $id_paiement]);

        
        $stmt = $pdo->prepare("
            INSERT INTO Paiements_Etats (ID_paiement, ID_etat_paiement) 
            VALUES (:paiement, (SELECT ID_etat_paiement FROM Etats_paiements WHERE Libelle_etat_paiement = 'Payé'))
        ");
        $stmt->execute(['paiement' => $id_paiement]);

        
        $stmt = $pdo->prepare("
            UPDATE Cours_Etats 
            SET ID_etat = (SELECT ID_etat FROM Etats_cours WHERE Libelle_etat = 'Payé') 
            WHERE ID_cours = :cours
        ");
        $stmt->execute(['cours' => $cours_id]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Requête invalide']);
}
?>