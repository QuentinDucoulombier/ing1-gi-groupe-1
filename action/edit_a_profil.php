<?php

session_start();
require('bdd.php');
//echo $_POST['nvemail'];
//on recupere l'email de l'utilisateur connecté
$email = $_POST['email'];
$infos = getUser($email);
$type = $infos[0]['type'];
echo $type;
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
        echo 'proute';
        $nomEntreprise = htmlspecialchars($_POST['nomEntreprise']);
        //echo $nomEntreprise;
        modifyEntreprise($email, $nomEntreprise);
    }

    if ($type == "Gestionnaire") {
        // Récupération des données POST envoyées par le formulaire
        $dateDebutUtilisateur = htmlspecialchars($_POST['dateDebutUtilisateur']);
        echo $dateDebutUtilisateur;
        modifyDateDebutUtilisateur($email, $dateDebutUtilisateur);

    }

    if ($type == "Gestionnaire") {
        // Récupération des données POST envoyées par le formulaire
        $dateFinUtilisateur = htmlspecialchars($_POST['dateFinUtilisateur']);

        modifyDateFinUtilisateur($email, $dateFinUtilisateur);
    }



    //si le niveau d'etude a été saisie dans le formulaire
    if ($type == "Etudiant" ) {
        // Récupération des données POST envoyées par le formulaire
        echo 'proute';
        $niv = $_POST['niveauEtude'];
        echo $niv;
        modifyLvl($email, $niv);
        
    }


    //si l'ecole a été saisie dans le formulaire
    if ($type == "Etudiant" ) {
        // Récupération des données POST envoyées par le formulaire
        $ecole = htmlspecialchars($_POST['ecole']);

        modifyEcole($email, $ecole);
         echo 'pipi';
    }


    //si la ville a été saisie dans le formulaire
    if ($type == "Etudiant" ) {
        // Récupération des données POST envoyées par le formulaire
        $ville = htmlspecialchars($_POST['ville']);

        modifyVille($email, $ville);
    }

    //si le mot de passe a été saisie dans le formulaire
    $mdp = $_POST['motDePasse'];
    modifyPasswordForAdmin($email, $mdp);
    // si le type a changé
    if ($type != $_POST['type']){
        $type = $_POST['type'];
        modifyType($email, $type);
    }
    
    $nvmail = htmlspecialchars($_POST['nvemail']);
    modifyEmail($email, $nvmail);
    //si l'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe ont été saisie dans le formulaire
    // if (!empty($_POST['password'])) {
    //     // Récupération des données POST envoyées par le formulaire

    //     $nouveauMdp = sha1($_POST['password']);


    //     modifyPassword($email, $ancienMdp, $nouveauMdp);
    // } else {
    //     $error = "L'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe doivent être remplis";
    // }
    // // afficher les erreurs
    // if (isset($error)) {
    //     echo $error;
    // }
    // afficher les valeurs
//     echo $_POST['prenomUtilisateur'];
//     echo $_POST['nomUtilisateur'];
//     echo $_POST['email'];
//     echo $_POST['nvemail'];
//     echo $_POST['numeroTel'];
//    // echo $_POST['niveauEtude'];
//     echo $_POST['ecole'];
//     echo $_POST['ville'];
//     echo $_POST['AncienPassword'];
//     echo $_POST['typePage'];

    if ($_POST['typePage'] == "profil") {
        // on change le mail dans la session
        $_SESSION['email'] = $nvmail;
        echo 'caca' ;
    }


}

//header('Location: /?page=gererUtilisateur');

?>