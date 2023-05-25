<?php
$serveur = "localhost";
$user = "quentin";
$pass = "*noeDu64*";
$dbname = "projetIaPau";
$conn = mysqli_connect($serveur, $user, $pass, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

/**
 * @fn function verifDestAuteur($auteur_msg, $destinataire_msg, $aut, $dest) 
 * @param $auteur_msg l'identifiant de l'auteur du message
 * @param $destinataire_msg l'identifiant du destinataire du message
 * @param $aut l'identifiant de l'auteur actuel
 * @param $dest l'identifiant du destinataire actuel
 * @return string le statut du message (envoye, recu ou false)
 * @brief vérifie si l'auteur et le destinataire du message correspondent aux identifiants actuels
 */
function verifDestAuteur($auteur_msg, $destinataire_msg, $aut, $dest) {
    if ($auteur_msg == $aut && $destinataire_msg == $dest) {

        return "envoye";
    }elseif($auteur_msg == $dest &&  $destinataire_msg == $aut){
        return "recu";
    }else{
        return "false";
    }
}

/*-------------------Auteur------------------*/
$queryAut = "SELECT idUtilisateur FROM Auteur";
$resultAut = mysqli_query($conn, $queryAut);

// Vérifier si la requête a réussi
if (!$resultAut) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
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
$resultDest = mysqli_query($conn, $queryDest);

// Vérifier si la requête a réussi
if (!$resultDest) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
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


// Requête pour récupérer les messages
/**FIXME: 
 * Faire la meme chose pour les destinatiare
 * Changer le nom de l'auteur dans le cas de recu
 * */
$query = "
SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur

UNION

SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_destinataire
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur

ORDER BY id_message ASC

";

// Exécuter la requête
$result = mysqli_query($conn, $query);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
}

// Tableau pour stocker les messages
$messages = array();

// Parcourir les résultats et construire le tableau des messages
while ($row = mysqli_fetch_assoc($result)) {
    $statut = verifDestAuteur($row["id_auteur"], $row["id_destinataire"],$idAut,$idDest);
    
    if ($statut != "false") {

    
        $message = array(
            "id" => $row["id_message"],
            "prenom" => $row["prenomUtilisateur"],
            "nom" => $row["nomUtilisateur"],
            "message" => $row["message"],
            "date_envoi" => $row["date_envoi"],
            "statut" => $statut
        );
    }
    else{
        $message = 1;
    }

    // Ajouter le message au tableau des messages
    $messages[] = $message;
}

// Libérer la mémoire du résultat
mysqli_free_result($result);

// Fermer la connexion à la base de données
mysqli_close($conn);

// Renvoyer les messages au format JSON
echo json_encode($messages);
?>
