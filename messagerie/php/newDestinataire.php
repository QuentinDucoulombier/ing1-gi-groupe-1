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
   

    $queryDestinataire = "UPDATE Destinataire SET id_user = '$idUser' WHERE id_destinataire = 1";
    $dbname = "messagerie";
    mysqli_select_db($cnx, $dbname);

    if(mysqli_query($cnx, $queryDestinataire)) {
        //echo "Les valeurs du destinataire ont été modifiées avec succès";
        $query = "select prenom,nom from User Inner join Destinataire ON Destinataire.id_user = User.id_user";
        $result = mysqli_query($cnx,$query);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                echo ''.$row['prenom'].' '.$row['nom'].'';
            }
        }
        else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($cnx);
        }
    } else {
        echo "Erreur lors de la modification des valeurs du destinataire : " . mysqli_error($cnx);
    }




    mysqli_close($cnx);

    //echo $prenomD." ".$nomD;

?>
