<?php
session_start();
require_once 'config.php';


if (!isset($_GET['cours_id'])) {
    header("Location: dashboard.php");
    exit();
}

$cours_id = $_GET['cours_id'];


$stmt = $pdo->prepare("
    SELECT c.*, m.Libelle_matiere, n.Libelle_niveau, d.Date_heure 
    FROM Cours c 
    JOIN Matieres m ON c.ID_matiere = m.ID_matiere 
    JOIN Niveaux n ON c.ID_niveau = n.ID_niveau 
    JOIN Disponibilites d ON c.ID_disponibilite = d.ID_disponibilite 
    WHERE c.ID_cours = :id AND c.ID_client = :client
");
$stmt->execute(['id' => $cours_id, 'client' => $_SESSION['client_id']]);
$cours = $stmt->fetch();

if (!$cours) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement - DevoirFacile</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { padding: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Paiement pour votre cours</h1>
        <p>Matière : <?php echo htmlspecialchars($cours['Libelle_matiere']); ?></p>
        <p>Niveau : <?php echo htmlspecialchars($cours['Libelle_niveau']); ?></p>
        <p>Date : <?php echo htmlspecialchars($cours['Date_heure']); ?></p>
        <p>Tarif : <?php echo htmlspecialchars($cours['Tarif']); ?> €</p>

        <div id="paypal-button-container"></div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=EUR"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $cours['Tarif']; ?>',
                            currency_code: 'EUR'
                        },
                        description: 'Cours de <?php echo $cours['Libelle_matiere']; ?>'
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    fetch('confirm_payment.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ cours_id: '<?php echo $cours_id; ?>' })
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            window.location.href = 'dashboard.php';
                        } else {
                            alert('Erreur lors de la confirmation du paiement.');
                        }
                    });
                });
            },
            onError: function(err) {
                alert('Erreur lors du paiement : ' + err);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>