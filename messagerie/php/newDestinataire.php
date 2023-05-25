<?php

    $serveur = "localhost";
    $user = "quentin";
    $pass = "*noeDu64*";
    $cnx = mysqli_connect($serveur, $user, $pass);

    if (mysqli_connect_errno($cnx)) {
        echo "Erreur de connexion à MySQL : " . mysqli_connect_error();
        exit();
    }

    $idUser = $_POST["id"];
   

    $dbname = "projetIaPau";
    mysqli_select_db($cnx, $dbname);


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


    /*Modifie le fait que l'utilisateur a vu le message*/

    $queryLu = "UPDATE Messages
    JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur
    SET Messages.lu = 1;";
    if(!(mysqli_query($cnx, $queryLu))) {
        echo "Erreur lors de la modification du vu : " . mysqli_error($cnx);
    }
    
    
    mysqli_close($cnx);

?>
