<?php
session_start();
?>

<head>
  <link rel="stylesheet" type="text/css" href="/css/accueil.css" />
  <script defer src="../js/accueil.js"></script>
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
        <li class="buttonC">
          <div onclick="deconnexion()">Déconnexion</div>
        </li>
      <?php } else { ?>
        <li class="buttonC" class="boutonmodal1">
          <div onclick="openLoginModal()">Connexion</div>
        </li>
        <li class="buttonC" classe="boutonmodal2">
          <div onclick="openLoginModal2()">S'inscrire</div>
        </li>
      <?php } ?>
    </ul>
  </div>

  <!-- Modal -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <span id="close" onclick="closeLoginModal()">&times;</span>
      <h2>Connexion</h2>
      <form id="loginForm" onsubmit="login(); return false;">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="motDePasse">Mot de passe:</label><br>
        <input type="password" id="motDePasse" name="motDePasse" required><br>
        <input type="submit" value="Se connecter">
      </form>
    </div>
  </div>
  <!-- Modal2 -->
  <div id="loginModal2" class="modal2">
    <div class="modal-content">
      <span id="close2" onclick="closeLoginModal2()">&times;</span>
      <h2>Incription</h2>
      <form id="loginForm" onsubmit="inscrire(); return false;">
        <label for="email2">Email:</label><br>
        <input type="email" id="email2" name="email2" required><br>
        <label for="prenomUtilisateur">Prénom:</label><br>
        <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" required><br>
        <label for="nomUtilisateur">Nom:</label><br>
        <input type="text" id="nomUtilisateur" name="nomUtilisateur" required><br>
        <label for="numeroTel">Numéro de téléphone:</label><br>
        <input type="tel" id="numeroTel" name="numeroTel" required><br>
        <label for="niveauEtude">Niveau d'étude:</label><br>
        <input type="text" id="niveauEtude" name="niveauEtude" required><br>
        <label for="ecole">Ecole:</label><br>
        <input type="text" id="ecole" name="ecole" required><br>
        <label for="ville">Ville:</label><br>
        <input type="text" id="ville" name="ville" required><br>
        <label for="motDePasse2">Mot de passe:</label><br>
        <input type="password" id="motDePasse2" name="motDePasse2" required><br>
        <label for="confirm_motDePasse">Confirmer mot de passe:</label><br>
        <input type="password" id="confirm_motDePasse" name="confirm_motDePasse" required><br>
        <input type="submit" value="S'inscrire">

      </form>
    </div>
  </div>

</header>