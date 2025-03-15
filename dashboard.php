<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['client_id'])) {
    header("Location: page2.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE ID_utilisateur = :id");
$stmt->execute(['id' => $_SESSION['client_id']]);
$utilisateur = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - DevoirFacile</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/templatemo-scholar.css">
    <style>
        .dashboard { padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container dashboard">
        <h1>Bienvenue, <?php echo htmlspecialchars($utilisateur['Nom']); ?> !</h1>

        <?php if ($utilisateur['Est_admin']) { ?>
            <!-- Dashboard Admin -->
            <h2>Dashboard Administrateur</h2>

            <h3>Ajouter une disponibilité</h3>
            <form action="ajouter_disponibilite.php" method="POST">
                <label>Date et heure :</label>
                <input type="datetime-local" name="date_heure" required>
                <input type="submit" value="Ajouter">
            </form>

            <h3>Cours réservés par les clients</h3>
            <?php
            $stmt = $pdo->query("
                SELECT c.ID_cours, u.Nom, m.Libelle_matiere, n.Libelle_niveau, d.Date_heure, e.Libelle_etat
                FROM Cours c
                JOIN Utilisateurs u ON c.ID_client = u.ID_utilisateur
                JOIN Matieres m ON c.ID_matiere = m.ID_matiere
                JOIN Niveaux n ON c.ID_niveau = n.ID_niveau
                JOIN Disponibilites d ON c.ID_disponibilite = d.ID_disponibilite
                JOIN Cours_Etats ce ON c.ID_cours = ce.ID_cours
                JOIN Etats_cours e ON ce.ID_etat = e.ID_etat
            ");
            echo "<table>";
            echo "<tr><th>Client</th><th>Matière</th><th>Niveau</th><th>Date</th><th>Statut</th></tr>";
            while ($cours = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($cours['Nom']) . "</td>";
                echo "<td>" . $cours['Libelle_matiere'] . "</td>";
                echo "<td>" . $cours['Libelle_niveau'] . "</td>";
                echo "<td>" . $cours['Date_heure'] . "</td>";
                echo "<td>" . $cours['Libelle_etat'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            ?>

        <?php } else { ?>
            <!-- Dashboard Client -->
            <h2>Dashboard Client</h2>

            <h3>Réserver un cours</h3>
            <form action="reserver.php" method="POST">
                <label>Niveau :</label>
                <select name="id_niveau" required>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM Niveaux");
                    while ($niveau = $stmt->fetch()) {
                        echo "<option value='" . $niveau['ID_niveau'] . "'>" . $niveau['Libelle_niveau'] . "</option>";
                    }
                    ?>
                </select>
                <label>Matière :</label>
                <select name="id_matiere" required>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM Matieres");
                    while ($matiere = $stmt->fetch()) {
                        echo "<option value='" . $matiere['ID_matiere'] . "'>" . $matiere['Libelle_matiere'] . "</option>";
                    }
                    ?>
                </select>
                <label>Date :</label>
                <select name="id_disponibilite" required>
                    <?php
                    $stmt = $pdo->query("
                        SELECT d.ID_disponibilite, d.Date_heure 
                        FROM Disponibilites d 
                        LEFT JOIN Cours c ON d.ID_disponibilite = c.ID_disponibilite 
                        WHERE c.ID_cours IS NULL
                    ");
                    while ($dispo = $stmt->fetch()) {
                        echo "<option value='" . $dispo['ID_disponibilite'] . "'>" . $dispo['Date_heure'] . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Réserver et payer">
            </form>
        <?php } ?>

        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</body>
</html>