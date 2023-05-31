<?php

session_start();
require('bdd.php');
//on recupere l'email de l'utilisateur connecté
$email = $_POST['email'];
$infos = getUser($email);
$type = $infos[0]['type'];
echo "ddd";
// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom = htmlspecialchars($_POST['prenomUtilisateur']);
    modifyUsername($email, $prenom);

    $nom = htmlspecialchars($_POST['nomUtilisateur']);
    modifyName($email, $nom);

    $tel = $_POST['numeroTel'];
    modifyTel($email, $tel);

    if ($type == "Gestionnaire") {
        // Récupération des données POST envoyées par le formulaire
        $nomEntreprise = htmlspecialchars($_POST['nomEntreprise']);
        modifyEntreprise($email, $nomEntreprise);
    }

    if ($type == "Gestionnaire") {
        // Récupération des données POST envoyées par le formulaire
        $dateDebutUtilisateur = htmlspecialchars($_POST['dateDebutUtilisateur']);
        modifyDateDebutUtilisateur($email, $dateDebutUtilisateur);

    }

    if ($type == "Gestionnaire") {
        // Récupération des données POST envoyées par le formulaire
        $dateFinUtilisateur = htmlspecialchars($_POST['dateFinUtilisateur']);
        modifyDateFinUtilisateur($email, $dateFinUtilisateur);
    }

    //si le niveau d'etude a été saisie dans le formulaire
    if ($type == "Etudiant") {
        // Récupération des données POST envoyées par le formulaire
        $niv = $_POST['niveauEtude'];
        modifyLvl($email, $niv);
    }

    //si l'ecole a été saisie dans le formulaire
    if ($type == "Etudiant") {
        // Récupération des données POST envoyées par le formulaire
        $ecole = htmlspecialchars($_POST['ecole']);
        modifyEcole($email, $ecole);
    }


    //si la ville a été saisie dans le formulaire
    if ($type == "Etudiant") {
        // Récupération des données POST envoyées par le formulaire
        $ville = htmlspecialchars($_POST['ville']);
        modifyVille($email, $ville);
    }
    echo $_POST['typePage'];
    if ($_POST['typePage'] == "profil") {
        echo $_POST['AncienMotDePasse'];
        echo $_POST['motDePasse'];
        modifyPassword($email,$_POST['AncienMotDePasse'],$_POST['motDePasse']);

    } else {
        modifyPasswordForAdmin($email,$_POST['motDePasse']);
    }
    

    // si le type a changé
    $nvtype = $_POST['type'];
    if ($type != $nvtype) {
        $nvtype = $_POST['type'];
        modifyType($email, $type);
    }

    $nvmail = htmlspecialchars($_POST['nvemail']);
    modifyEmail($email, $nvmail);

    if ($_POST['typePage'] == "profil") {
        // on change le mail dans la session
        $_SESSION['email'] = $nvmail;
    }
}
?>