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

// Requête pour récupérer les messages
$query = "
    SELECT Messages.id_message, User.prenom, User.nom, Messages.message, Messages.date_envoi, Messages.lu
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
    $message = array(
        "id" => $row["id_message"],
        "prenom" => $row["prenom"],
        "nom" => $row["nom"],
        "message" => $row["message"],
        "date_envoi" => $row["date_envoi"],
        //"supprime" => ($row["lu"] == 1) // Si le message est marqué comme "lu", alors il est supprimé
    );

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
