<?php

session_start();
require('bdd.php');

//on recupere l'email de l'utilisateur connecté
$email = $_SESSION['email'];
// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //si le prenom a été saisie dans le formulaire
    if (!empty($_POST['prenomUtilisateur'])) {
        // Récupération des données POST envoyées par le formulaire
        $prenom = htmlspecialchars($_POST['prenomUtilisateur']);
        
        if (strlen($prenom) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "prenom trop long";
        } 
        modifyUsername($email, $prenom);
    }
    //si le nom a été saisie dans le formulaire
    if (!empty($_POST['nomUtilisateur'])) {
        // Récupération des données POST envoyées par le formulaire
        $nom = htmlspecialchars($_POST['nomUtilisateur']);
        
        if (strlen($nom) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "nom trop long";
        } 
        modifyName($email, $nom);
    }
    //si le numero de telephone a été saisie dans le formulaire
    if (!empty($_POST['numeroTel'])) {
        // Récupération des données POST envoyées par le formulaire
        $tel = $_POST['numeroTel'];
        
        if (strlen($tel) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "numero de telephone trop long";
        } 
        modifyTel($email, $tel);
    }
    //si le niveau d'etude a été saisie dans le formulaire
    if (!empty($_POST['niveauEtude'])) {
        // Récupération des données POST envoyées par le formulaire
        $niv = $_POST['niveauEtude'];
        
        if (strlen($niv) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "niveau d'etude trop long";
        } 
        modifyLvl($email, $niv);
    }
    //si l'ecole a été saisie dans le formulaire
    if (!empty($_POST['ecole'])) {
        // Récupération des données POST envoyées par le formulaire
        $ecole = htmlspecialchars($_POST['ecole']);
        
        if (strlen($ecole) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "ecole trop long";
        } 
        modifyEcole($email, $ecole);
    }
    //si la ville a été saisie dans le formulaire
    if (!empty($_POST['ville'])) {
        // Récupération des données POST envoyées par le formulaire
        $ville = htmlspecialchars($_POST['ville']);
        
        if (strlen($ville) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "ville trop long";
        } 
        modifyVille($email, $ville);
    }
    //si l'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe ont été saisie dans le formulaire
    if (!empty($_POST['AncienPassword']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        // Récupération des données POST envoyées par le formulaire
        $ancienMdp = sha1($_POST['AncienPassword']);
        $nouveauMdp = sha1($_POST['password']);
        $confirmationMdp = sha1($_POST['confirm_password']);
        
        modifyPassword($email, $ancienMdp, $nouveauMdp);
        
    } else {
        $error = "L'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe doivent être remplis";
    }


}

header('Location: ../pages/profil.php');
?>