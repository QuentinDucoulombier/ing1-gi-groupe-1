<?php
session_start();
require('bdd.php');

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

  if ($motDePasse !== $confirm_motDePasse) {
    $error = "mot de passe non égale a confirm mot de passe";
    exit;
  } else {
    addEtudiant($email, $motDePasse, $nom, $prenom, $tel, $niv, $ecole, $ville);
  }
}

header ('Location: /?page=accueil');
?>