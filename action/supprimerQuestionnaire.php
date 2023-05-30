<?php

session_start();
require('bdd.php');

//on recupere l'email de l'utilisateur connecté
$idQuestionnaire = $_POST['idQuestionnaire'];
echo $idQuestionnaire;
// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
deleteQuestionnaire($idQuestionnaire);
echo $idQuestionnaire;
}

 
// header('Location: /?page=gererUtilisateur');

?>