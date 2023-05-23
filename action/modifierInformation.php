<?php
session_start();
require('bdd.php');
$connexion = connect();

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
        modifyUsername($connexion, $email, $prenom);
    }
    //si le nom a été saisie dans le formulaire
    if (!empty($_POST['nomUtilisateur'])) {
        // Récupération des données POST envoyées par le formulaire
        $nom = htmlspecialchars($_POST['nomUtilisateur']);
        
        if (strlen($nom) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "nom trop long";
        } 
        modifyName($connexion, $email, $nom);
    }
    //si le numero de telephone a été saisie dans le formulaire
    if (!empty($_POST['numeroTel'])) {
        // Récupération des données POST envoyées par le formulaire
        $tel = $_POST['numeroTel'];
        
        if (strlen($tel) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "numero de telephone trop long";
        } 
        modifyTel($connexion, $email, $tel);
    }
    //si le niveau d'etude a été saisie dans le formulaire
    if (!empty($_POST['niveauEtude'])) {
        // Récupération des données POST envoyées par le formulaire
        $niv = $_POST['niveauEtude'];
        
        if (strlen($niv) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "niveau d'etude trop long";
        } 
        modifyLvl($connexion, $email, $niv);
    }
    //si l'ecole a été saisie dans le formulaire
    if (!empty($_POST['ecole'])) {
        // Récupération des données POST envoyées par le formulaire
        $ecole = htmlspecialchars($_POST['ecole']);
        
        if (strlen($ecole) > 100) {
            // Vérification que le nom rentre bien dans la base de donnée
            $error = "ecole trop long";
        } 
        modifyEcole($connexion, $email, $ecole);
    }
    //si l'ancien mot de passe et le nouveau mot de passe et la confirmation du nouveau mot de passe ont été saisie dans le formulaire
    if (!empty($_POST['ancienMdp']) && !empty($_POST['nouveauMdp']) && !empty($_POST['confirmationMdp'])) {
        // Récupération des données POST envoyées par le formulaire
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];
        $confirmationMdp = $_POST['confirmationMdp'];
        //on verifie que le nouveau mot de passe et la confirmation du nouveau mot de passe sont identiques
        if ($nouveauMdp == $confirmationMdp) {
            //on verifie que l'ancien mot de passe est correct
            modifyPassword($connexion, $email, $ancienMdp, $neaouveauMdp);

            } else {
                $error = "ancien mot de passe incorrect";
            }
        } else {
            $error = "nouveau mot de passe et confirmation du nouveau mot de passe différents";
        }
 }

header('Location: ../pages/profil.php');
?>