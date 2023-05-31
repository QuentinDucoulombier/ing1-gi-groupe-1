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
$idEvent = $_POST['id'];
$type = $_POST['type'];

addProjetData($idEvent, $nomProjet, $description, $image, $fichier, $video, $conseil, $consigne);

if (isset($_POST['action'])) {
    $valeurBouton = $_POST['action'];
    // Utilisez la valeur du bouton pour effectuer une action spécifique
    if ($valeurBouton === 'Valider le projet') {
        if ($type ==="dataChallenge"){
            header('Location: /?page=dataChallenge&challenge='.$idEvent);
        }
        else{
            header('Location: /?page=dataBattle&battle='.$idEvent);
        }
    } elseif ($valeurBouton === 'Valider et ajouter un autre projet') {
        header('Location: /?page=ajoutProjet&type='.$type.'&evenement='.$idEvent.'&v');
    }
  }


?>