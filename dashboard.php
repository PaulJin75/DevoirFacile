<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace membre</title>
</head>
<body>
    <h2>Bienvenue, <?php echo $_SESSION["username"]; ?> !</h2>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
