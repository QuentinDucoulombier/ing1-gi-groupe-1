<?php

session_start();
require('bdd.php');

//on recupere l'email de l'utilisateur connecté
$email = $_POST['email'];

// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
deleteUser($email);

}

?>