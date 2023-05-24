<?php
session_start();
require('bdd.php');
$connexion = connect();

// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données POST envoyées par le formulaire
  $email = htmlspecialchars($_POST['email']);
  $prenom = htmlspecialchars($_POST['prenomUtilisateur']);
  $nom = htmlspecialchars($_POST['nomUtilisateur']);
  $tel = $_POST['numeroTel'];
  $niv = $_POST['niveauEtude'];
  $ecole = htmlspecialchars($_POST['ecole']);
  $ville = htmlspecialchars($_POST['ville']);
  $motDePasse = sha1($_POST['motDePasse']);
  $confirm_motDePasse = sha1($_POST['confirm_motDePasse']);

  // // Vérification si les champs sont remplis
  if (empty($email) || empty($motDePasse) || empty($confirm_motDePasse)) {
    $error = "Tous les champs sont obligatoires.";
  } else if ($motDePasse !== $confirm_motDePasse) {
    $error = "Les deux mots de passe ne correspondent pas.";
  } else if (strlen($email) > 100) {
    // Vérification que le nom rentre bien dans la base de donnée
    $error = "Nom utilisateur trop long";
  } else {

  }


  // On regarde si l'email est déjà utilisé
  $sqlQuery = "select `email` FROM Utilisateur WHERE email LIKE :email";
  $statement = $connexion->prepare($sqlQuery);
  $statement->bindParam(':email', $email);
  $statement->execute();
  $result = $statement->rowCount();

  if ($result > 0) {
    echo "utilise";
    exit;

  } else {
    // Ecriture du nouvel utilisateur dans la base de données
    addEtudiant($connexion, $email, $motDePasse, $nom, $prenom, $tel, $niv, $ecole, $ville);
    header ('Location: /pages/accueil.php');
    echo "success";
    
  }
}


?>