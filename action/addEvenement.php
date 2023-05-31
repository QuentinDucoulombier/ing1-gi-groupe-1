

<?php

require('bdd.php');

// Récupération des données envoyées par le formulaire
$type = $_POST['type'];
$nomEvenement = $_POST['nomEvenement'];
$dateDebut = $_POST['dateDebut'];
$dateFin = $_POST['dateFin'];
$description = $_POST['description'];
$image = $_POST['image'];

addEvent($nomEvenement, $dateDebut, $dateFin, $type, $description, $image);



//header('Location: /?page=ajoutProjet');

?>