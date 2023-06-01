<?php

require('bdd.php');

// Récupération des données envoyées par le formulaire
$nomEvenement = $_POST['nomEvenement'];
$dateDebut = $_POST['dateDebut'];
$dateFin = $_POST['dateFin'];
$description = $_POST['description'];
$image = $_POST['image'];
$idEvent = $_POST['id'];

if ($nomEvenement != NULL) {
    updateNomEvent($idEvent, $nomEvenement);
}
if ($dateDebut != NULL) {
    updateDateD($idEvent, $dateDebut);
}
if ($dateFin != NULL) {
    updateDateF($idEvent, $dateFin);
}
if ($description != NULL) {
    updateDescriptionEvent($idEvent, $description);
}
if ($image != NULL) {
    updateImageEvent($idEvent, $image);
}

header('Location: /?page=evenements');

?>