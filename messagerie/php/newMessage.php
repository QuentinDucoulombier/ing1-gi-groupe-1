<?php
    $serveur = "localhost";
    $user = "quentin";
    $pass = "*noeDu64*";
    $cnx = mysqli_connect($serveur, $user, $pass);

    if (mysqli_connect_errno($cnx)) {
        echo "Erreur de connexion a MySQL: " . mysqli_connect_error();
        exit();
    }

    $message = $_POST["message"];

    $dbname = "messagerie";
    mysqli_select_db($cnx, $dbname);
    $query = "INSERT INTO Messages(message,date_envoi)
    VALUES ('$message', NOW())";


    if(mysqli_query($cnx,$query)) {
    echo "Enregistrement inséré avec succés";
    } else {
    echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
    }
    

    mysqli_close($cnx);

?>