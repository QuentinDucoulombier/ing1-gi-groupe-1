<?php

require('bdd.php');

// Récupération des données envoyées par le formulaire
$nomProjet = $_POST['nomProjet'];
$description = $_POST['description'];
$conseil = $_POST['conseil'];
$consigne = $_POST['consigne'];
$fichier = $_POST['fichier'];
$video = $_POST['video'];
$image = $_POST['image'];
$idProjet = $_POST['id'];

if ($nomProjet != NULL) {
    updateNomProjet($idProjet, $nomProjet);
}
if ($description != NULL) {
    updateDescProjet($idProjet, $description);
}
if ($conseil != NULL) {
    updateConseilProjet($idProjet, $conseil);
}
if ($consigne != NULL) {
    updateConsigneProjet($idProjet, $consigne);
}
if ($fichier != NULL) {
    updatefichierProjet($idProjet, $fichier);
}
if ($video != NULL) {
    updateVideoProjet($idProjet, $video);
}
if ($image != NULL) {
    updateimageProjet($idProjet, $image);
}


header('Location: /?page=evenements');


?>