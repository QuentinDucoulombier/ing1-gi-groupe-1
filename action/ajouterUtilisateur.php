<?php

session_start();
require('bdd.php');

$type = $_POST['type'];

// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $prenom = htmlspecialchars($_POST['prenomUtilisateur']);
    $nom = htmlspecialchars($_POST['nomUtilisateur']);
    $motDePasse = sha1($_POST['motDePasse']);
    $tel = $_POST['numeroTel'];


    if ($type == "Gestionnaire") {
        $nomEntreprise = $_POST['nomEntreprise'];
        $dateDebutUtilisateur = $_POST['dateDebutUtilisateur'];
        $dateFinUtilisateur = $_POST['dateFinUtilisateur'];
 
        addGestionnaireExterne($email, $motDePasse, $nom, $prenom, $tel, $nomEntreprise, $dateDebutUtilisateur, $dateFinUtilisateur);
    }
    if ($type == "Etudiant") {

        $niv = $_POST['niveauEtude'];
        $ecole = htmlspecialchars($_POST['ecole']);
        $ville = htmlspecialchars($_POST['ville']);

        addEtudiant($email, $motDePasse, $nom, $prenom, $tel, $niv, $ecole, $ville);


    }






}
?>