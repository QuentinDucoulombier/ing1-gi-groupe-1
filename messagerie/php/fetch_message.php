<?php
$serveur = "localhost";
$user = "quentin";
$pass = "*noeDu64*";
$dbname = "messagerie";
$conn = mysqli_connect($serveur, $user, $pass, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

/*TODO: Verifier si le msg est un msg recu ou envoyé*/
//$statut peut etre égale a envoye, recu ou false
//envoye si c'est l'auteur qui l'a envoyer et le destinataire qui l'a recu
//recu si c'est le destinaire qui l'a recu et l'auteur qui l'a envoyer
//false dans les autres cas
function verifDestAuteur($auteur_msg, $destinataire_msg, $aut, $dest) {
    if ($auteur_msg == $aut && $destinataire_msg == $dest) {

        return "envoye";
    }elseif($auteur_msg == $dest &&  $destinataire_msg == $auteur_msg){
        return "recu";
    }else{
        return "false";
    }
}

/*-------------------Auteur------------------*/
$queryAut = "SELECT id_user FROM Auteur";
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
$queryDest = "SELECT id_user FROM Destinataire";
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
$query = "
    SELECT Messages.id_message, User.prenom, User.nom, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
    FROM Messages
    JOIN Auteur ON Auteur.id_auteur = Messages.id_auteur
    JOIN User ON User.id_user = Auteur.id_user
    ORDER BY Messages.id_message ASC
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
            "prenom" => $row["prenom"],
            "nom" => $row["nom"],
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
