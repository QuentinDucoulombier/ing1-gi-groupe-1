<?php
        /*
        $prenom =  $_SESSION["prenom"];
        $nom = $_SESSION["nom"];
        $status = $_SESSION["status"];
        $img = $_SESSION["image"];
        $email = $_SESSION["email"];*/
        $prenomA =  "Test";
        $nomA = "Ducou";
        $emailA = "test";

        $prenomD =  "TestD";
        $nomD = "NomD";
        $emailD = "TestD";


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


        /*AJOUT AUTEUR*/
        $query = "INSERT INTO Auteur(prenom,nom,email)
                    VALUES ('$prenomA','$nomA','$emailA')";


        if(mysqli_query($cnx,$query)) {
            echo "Enregistrement inséré avec succés";
        } else {
            echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
        }

        /*AJOUT DESTINATAIRE*/
        $query = "INSERT INTO Destinateur(prenom,nom,email)
                    VALUES ('$prenomD','$nomD','$emailD')";


        if(mysqli_query($cnx,$query)) {
            echo "Enregistrement inséré avec succés";
        } else {
            echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
        }

        mysqli_close($cnx);
