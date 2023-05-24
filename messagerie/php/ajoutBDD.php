<?php
        
    session_start();

/*
    $prenom =  $_SESSION["prenom"];
    $nom = $_SESSION["nom"];
    $status = $_SESSION["status"];
    $img = $_SESSION["image"];
    $email = $_SESSION["email"];
    $prenomA =  "Test";
    $nomA = "Ducou";
    $emailA = "test";

    $_SESSION["auteur"] = '{
        "nom":"'.$nomA.'",
        "prenom":"'.$prenomA.'",
        "adresse_mail":"'.$emailA.'"
    }';
    $_SESSION["prenom"] = $prenomA;
    $_SESSION["nom"] = $nomA;
    $_SESSION["email"] = $emailA;


    $prenomD =  "TestD";
    $nomD = "NomD";
    $emailD = "TestD";
*/

    $serveur = "localhost";
    $user = "quentin";
    $pass = "*noeDu64*";
    $cnx = mysqli_connect($serveur, $user, $pass);

    if (mysqli_connect_errno($cnx)) {
        echo "Erreur de connexion a MySQL: " . mysqli_connect_error();
        exit();
    }

    $dbname = "messagerie";
    mysqli_select_db($cnx, $dbname);

/*Ajout User
    $query = "INSERT INTO User(prenom,nom,email)
                VALUES ('$prenomA','$nomA','$emailA')";


    if(mysqli_query($cnx,$query)) {
        echo "Enregistrement inséré avec succés";
    } else {
        echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
    }
    $query = "INSERT INTO User(prenom,nom,email)
                VALUES ('$prenomD','$nomD','$emailD')";


    if(mysqli_query($cnx,$query)) {
        echo "Enregistrement inséré avec succés";
    } else {
        echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
    }
*/

/*  Modif AUTEUR
    $query = "UPDATE Auteur SET prenom = '$prenomA', nom = '$nomA', email = '$emailA' WHERE id_auteur = 1";

    if(mysqli_query($cnx, $query)) {
        echo "Les valeurs ont été modifiées avec succès";
    } else {
        echo "Erreur lors de la modification des valeurs : " . mysqli_error($cnx);
    }


    //AJOUT DESTINATAIRE
    $queryDestinataire = "UPDATE Destinataire SET prenom = '$prenomD', nom = '$nomD', email = '$emailD' WHERE id_destinataire = 1";

    if(mysqli_query($cnx, $queryDestinataire)) {
        echo "Les valeurs du destinataire ont été modifiées avec succès";
    } else {
        echo "Erreur lors de la modification des valeurs du destinataire : " . mysqli_error($cnx);
    }
*/

    mysqli_close($cnx);
?>