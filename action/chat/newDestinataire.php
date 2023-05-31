<?php

    require('../bdd.php');
    $cnx = conn2();


    $idUser = $_POST["id"];
   

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

    /*Modification du Destinataire*/
    $queryDestinataire = "UPDATE Destinataire SET idUtilisateur = '$idUser'";
    if(mysqli_query($cnx, $queryDestinataire)) {
        //echo "Les valeurs du destinataire ont été modifiées avec succès";
        $query = "select prenomUtilisateur,nomUtilisateur from Utilisateur Inner join Destinataire ON Destinataire.idUtilisateur = Utilisateur.idUtilisateur";
        $result = mysqli_query($cnx,$query);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                echo ''.$row['prenomUtilisateur'].' '.$row['nomUtilisateur'].'';
            }
        }
        else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($cnx);
        }
    } else {
        echo "Erreur lors de la modification des valeurs du destinataire : " . mysqli_error($cnx);
    }


    $queryLu = "UPDATE Messages
    SET Messages.lu = 1
    WHERE Messages.id_destinataire = $idAut AND Messages.id_auteur = $idUser;
    ";
    if(!(mysqli_query($cnx, $queryLu))) {
        echo "Erreur lors de la modification du vu : " . mysqli_error($cnx);
    }
    
    
    mysqli_close($cnx);

?>
