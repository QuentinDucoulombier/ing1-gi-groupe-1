<?php
session_start();
?>

<head>
  <link rel="stylesheet" type="text/css" href="/css/accueil.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<header>

  <div>
    <a href="/pages/accueil.php"><img class="logo" src="/images/logo.png" alt="Logo"> </a>
    <a href="/pages/accueil.php">
      <h1 class="Titre">Accueil</h1>
    </a>
  </div>
  
  <div class="MonCompte">
    <h3 id="buttonC2">Mon Compte</h3>
    <ul id="MonCompteMenu" class="MonCompteMenu">
      <?php if (isset($_SESSION['email'])) { ?>
        <li class="buttonC"><a href="/pages/profil.php">Mon Profil </a></li>
        <li class="buttonC"><a href="/action/deconnexion.php">Déconnexion </a> </li>
      <?php } else { ?>
        <li class="buttonC" ><a href="/pages/pageConnexion.php">Connexion</a></li>
        <li class="buttonC" ><a href="/pages/pageInscription.php">S'inscrire</a></li>
      <?php } ?>
    </ul>
  </div>

</header>