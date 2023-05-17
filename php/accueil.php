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
    <a href="/menu.php"><img class="logo" src="/images/logo.png" alt="Logo"> </a>
    <a href="/menu.php">
      <h1 class="Titre">Accueil</h1>
    </a>
  </div>
  
  <div class="MonCompte">
    <h3 id="buttonC2">Mon Compte</h3>
    <ul id="MonCompteMenu" class="MonCompteMenu">
      <?php if (isset($_SESSION['id'])) { ?>
        <?php
        $id = $_SESSION['id'];
          $url = "/php/profil.php?id=" . urlencode($id);
        ?>
        <li class="buttonC"><a href="<?php echo $url; ?>">Mon Profil </a></li>
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
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
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
        <label for="username2">Nom d'utilisateur:</label><br>
        <input type="text" id="username2" name="username2" required><br>
        <label for="password2">Mot de passe:</label><br>
        <input type="password" id="password2" name="password2" required><br>
        <label for="confirm_password">Confirmer mot de passe:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <input type="submit" value="S'inscrire">
      </form>
    </div>
  </div>

</header>