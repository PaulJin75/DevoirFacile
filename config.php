<?php
    // Définition des constantes   
    // pour le serveur local
    define("local_serveur", "localhost");
    define("local_username", "root");
    define("local_password", "");
    define("local_base", "devoirfacile");

    // Création de la connection
    $ma_connexion = mysqli_connect(local_serveur, local_username, local_password, local_base);

    // Vérification de la réussite de la connection
    if (!$ma_connexion) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else {
        echo "Connected successfully <br>";
    }
