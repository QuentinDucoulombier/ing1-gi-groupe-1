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

    $dbname = "projetIaPau";
    
    mysqli_select_db($cnx, $dbname);


    /*-------------------Auteur------------------*/
    $queryAut = "SELECT idUtilisateur FROM Auteur";
    $resultAut = mysqli_query($cnx, $queryAut);

    // Vérifier si la requête a réussi
    if (!$resultAut) {
        die("Erreur lors de l'exécution de la requête : " . mysqli_error($cnx));
    }

    $rowAut = mysqli_fetch_row($resultAut);

    // Vérifier s'il y a une ligne de résultat
    if ($rowAut) {
        // Récupérer la première colonne (le nombre)
        $idAut = $rowAut[0];
    } else {
        // Aucun résultat trouvé, définir $id sur une valeur par défaut ou afficher un message d'erreur
        $idAut = null; // ou une autre valeur par défaut de votre choix
    }

    // Libérer la mémoire du résultat
    mysqli_free_result($resultAut);


    /*----------------Destinataire----------------*/
    $queryDest = "SELECT idUtilisateur FROM Destinataire";
    $resultDest = mysqli_query($cnx, $queryDest);

    // Vérifier si la requête a réussi
    if (!$resultDest) {
        die("Erreur lors de l'exécution de la requête : " . mysqli_error($cnx));
    }

    $rowDest = mysqli_fetch_row($resultDest);

    // Vérifier s'il y a une ligne de résultat
    if ($rowDest) {
        // Récupérer la première colonne (le nombre)
        $idDest = $rowDest[0];
    } else {
        $idDest = null; 
    }

    // Libérer la mémoire du résultat
    mysqli_free_result($resultDest);


    /*--------------Ajout nouveau message--------------*/
    $query = "INSERT INTO Messages(message,date_envoi,id_auteur, id_destinataire)
    VALUES ('$message', NOW(),$idAut,$idDest)";


    if(mysqli_query($cnx,$query)) {
    echo "Enregistrement inséré avec succés";
    } else {
    echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($cnx);
    }
    

    mysqli_close($cnx);

?>