<?php
session_start();
require('config.php');

// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données POST envoyées par le formulaire
  $username = htmlspecialchars($_POST['username2']);
  $password = sha1($_POST['password2']);
  $confirm_password = sha1($_POST['confirm_password']);


  // Vérification si les champs sont remplis
  if (empty($username) || empty($password) || empty($confirm_password)) {
    $error = "Tous les champs sont obligatoires.";
  } else if ($password !== $confirm_password) {
    $error = "Les deux mots de passe ne correspondent pas.";
  } else if (strlen($username) > 100) {
    // Vérification que le nom rentre bien dans la base de donnée
    $error = "Nom utilisateur trop long";
  } else {

  }


  // On regarde si l'utilisateur existe déjà
  $req = $connexion->prepare("SELECT id FROM compte WHERE nom='$username'");
  $req->execute();
  $found = $req->fetch();
  if ($found) {
    echo "utilise";
    exit;

  } else {
    // Ecriture du nouvel utilisateur dans la base de données
    $insert = $connexion->prepare("INSERT INTO compte(nom,password,statut) VALUES (?,?,'etudiant')");
    $insert->bind_param('ss', $username, $password);
    $insert->execute();

    echo "success";
    exit;
  }
}

?>