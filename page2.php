<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>DevoirFacile</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-scholar.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/monstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<p style="color: green;">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="assets/images/frontImg.jpg" alt="">
                <div class="text">
                    <span class="text-1"><br></span>
                    <span class="text-2"></span>
                </div>
            </div>
            <div class="back">
                <img src="assets/images/backImg.jpg" alt="">
                <div class="text">
                    <span class="text-1"><br></span>
                    <span class="text-2"></span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Connexion</div>
                    <form action="connexion.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Saisissez votre email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Saisissez votre mot de passe" required>
                            </div>
                            <div class="text"><a href="#">Mot de passe oublié ?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Se connecter">
                            </div>
                            <div class="text sign-up-text">Pas encore de compte ? <label for="flip">Inscrivez-vous</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Inscription</div>
                    <form action="inscription.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Saisissez votre nom" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Saisissez votre email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Saisissez votre mot de passe" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="S'inscrire">
                            </div>
                            <div class="text sign-up-text">Déjà inscrit ? <label for="flip">Connectez-vous</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>