<?php
session_start();
require('bdd.php');

// Récupération des données POST envoyées par le formulaire de login

if (isset($_POST['email']) && isset($_POST['motDePasse'])) {
  $email = htmlspecialchars($_POST['email']);
  $motDePasse = sha1($_POST['motDePasse']); 
  

  // Vérification si les champs sont remplis
  if (empty($email) || empty($motDePasse)) {
    echo "error";
    exit;
  }
 

  $found = isUser($email, $motDePasse);

  // Envoi de la réponse au client
  if ($found == 1) {
    // Démarrage de la session
    // Stockage de l'email dans la session
    $_SESSION['email'] = $email;
    echo "success";

  } else {
    echo "error";
    exit;

  }
}
header ('Location: /?page=accueil');

?>