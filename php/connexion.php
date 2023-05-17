<?php
session_start();
require('config.php');
// Récupération des données POST envoyées par le formulaire de login

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username =htmlspecialchars($_POST['username']);
  $password = sha1($_POST['password']);
  // Vérification si les champs sont remplis
  if (empty($username) || empty($password)) {
    echo "error";
    exit;
  }

  $requsr = "SELECT * FROM compte WHERE nom = '$username'  AND password='$password'";
  $result = mysqli_query($connexion, $requsr) or die('Pb req : ' . $requsr);
  $found = mysqli_num_rows($result);

  // Envoi de la réponse au client
  if ($found == 1) {
    // Démarrage de la session
    // Stockage de l'ID utilisateur dans la session
    $infoUtilisateur = $result->fetch_assoc();
    $id = $infoUtilisateur['id'] ;
    $_SESSION['id'] = $id;
    echo "success";

  } else {
    echo "error";

  }
}
?>