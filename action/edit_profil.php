<?php

session_start();
require('bdd.php');

//on recupere l'email de l'utilisateur connecté
$email = $_SESSION['email'];
$infos = getUser($email);
$type = $infos[0]['type'];
// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //si le prenom a été saisie dans le formulaire
    if (!empty($_POST['prenomUtilisateur'])) {
        // Récupération des données POST envoyées par le formulaire
        $prenom = htmlspecialchars($_POST['prenomUtilisateur']);

        modifyUsername($email, $prenom);
    }


    //si le nom a été saisie dans le formulaire
    if (!empty($_POST['nomUtilisateur'])) {
        // Récupération des données POST envoyées par le formulaire
        $nom = htmlspecialchars($_POST['nomUtilisateur']);


        modifyName($email, $nom);
    }


    //si le numero de telephone a été saisie dans le formulaire
    if (!empty($_POST['numeroTel'])) {
        // Récupération des données POST envoyées par le formulaire
        $tel = $_POST['numeroTel'];

        modifyTel($email, $tel);
    }

    if ($type == "Gestionnaire" && !empty($_POST['nomEntreprise'])) {
        // Récupération des données POST envoyées par le formulaire
        $nomEntreprise = htmlspecialchars($_POST['nomEntreprise']);

        modifyEntreprise($email, $nomEntreprise);
    }

    // if ($type == "Gestionnaire" && !empty($_POST['dateFinUtilisateur'])) {
    //     // Récupération des données POST envoyées par le formulaire
    //     $dateFinUtilisateur = htmlspecialchars($_POST['dateFinUtilisateur']);

    //     modifyDateFinUtilisateur($email, $dateFinUtilisateur);
    // }


    //si le niveau d'etude a été saisie dans le formulaire
    if ($type == "Etudiant" && !empty($_POST['niveauEtude'])) {
        // Récupération des données POST envoyées par le formulaire
        $niv = $_POST['niveauEtude'];

        modifyLvl($email, $niv);
    }


    //si l'ecole a été saisie dans le formulaire
    if ($type == "Etudiant" && !empty($_POST['ecole'])) {
        // Récupération des données POST envoyées par le formulaire
        $ecole = htmlspecialchars($_POST['ecole']);

        modifyEcole($email, $ecole);
    }


    //si la ville a été saisie dans le formulaire
    if ($type == "Etudiant" && !empty($_POST['ville'])) {
        // Récupération des données POST envoyées par le formulaire
        $ville = htmlspecialchars($_POST['ville']);

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
if ($type == "Etudiant") {
    header('Location: /?page=profilEtudiant');
} else if ($type == "Gestionnaire") {
    header('Location: /?page=profilGestionnaire');
} else if ($type == "Administrateur") {
    header('Location: /?page=profilAdmin');
} else {
    echo 'error';
}

?>