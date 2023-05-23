<?php

require('../action/bdd.php');
require('accueil.php');
$connexion = connect();
?>
<!DOCTYPE html>
<?php

if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email
    
    
    $infos = getUser($connexion, $email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/profil.css" />
        <script defer src="../js/profil.js"></script>


        <title>Profil</title>
    </head>
 
    <body>
        <div class="prenomUtilisateur">
            <h2> Nom : </h2>
            <?php
            echo "<h2>" . $prenomUtilisateur . "</h2>";
            ?>
        </div>
        <div class="mdp">
            <h2> Modifier le mot de passe :</h2>
            <li class="buttonC" class="boutonmodalMdp">
                <div onclick="openMdpModal()">Modifier votre mot de passe</div>
            </li>
        </div>
        <div class="nomUtilisateur">
            <h2> Prénom : </h2>
            <?php
            echo "<h2>" . $infos[0]['nomUtilisateur'] . "</h2>";
            ?>
        </div>
        <div class="email">
            <h2> Email : </h2>
            <?php
            echo "<h2>" . $infos[0]['email'] . "</h2>";
            ?>
        </div>
        <div class="numeroTel">
            <h2> Numéro de téléphone : </h2>
            <?php
            echo "<h2>" . $infos[0]['numeroTel'] . "</h2>";
            ?>
        </div>
        <div class="niveauEtude">
            <h2> Niveau d'étude : </h2>
            <?php
            echo "<h2>" . $infos[0]['niveauEtude'] . "</h2>";
            ?>
        </div>
        <div class="ecole">
            <h2> Ecole : </h2>
            <?php
            echo "<h2>" . $infos[0]['ecole'] . "</h2>";
            ?>
        </div>
        <div class="ville">
            <h2> Ville : </h2>
            <?php
            echo "<h2>" . $infos[0]['ville'] . "</h2>";
            ?>
        </div>
        <div class="modifier">
            <li class="buttonC" class="boutonmodifier">
                <div onclick="openModifierModal()">Modifier vos informations</div>
            </li>
    </body>

    </html>
    <!-- <div id="mdpModal" class="modal">
        <div class="modal-content">
            <span id="closeMdp" onclick="closeMdpModal()">&times;</span>
            <h2>Modifier votre mot de passe</h2>
            <form id="loginForm" onsubmit="inscrire(); return false;">
                <label for="username2">Mot de passe:</label><br>
                <input type="password" id="passwordmdf" name="password" required><br>
                <label for="password2">Nouveau mot de passe:</label><br>
                <input type="password" id="newPassword" name="newPassword" required><br>
                <label for="confirm_password">Confirmer nouveau mot de passe:</label><br>
                <input type="password" id="confirm_passwordmdf" name="confirm_password" required><br>
                <input type="submit" value="Valider">
            </form>
        </div>
    </div> -->
    <div id="modifierModal">
    <div class="modal-content">
        <span id="closeModifier" onclick="closeModifierModal()">&times;</span>
        <h2>Modifier vos informations</h2>
        <form id="modifierForm" action="../action/modifierInformation.php" method="POST">
            <label for="prenomUtilisateur">Prénom:</label><br>
            <input type="text" id="prenomUtilisateur" name="prenomUtilisateur"><br>
            <label for="nomUtilisateur">Nom:</label><br>
            <input type="text" id="nomUtilisateur" name="nomUtilisateur"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="numeroTel">Numéro de téléphone:</label><br>
            <input type="tel" id="numeroTel" name="numeroTel"><br>
            <label for="niveauEtude">Niveau d'étude:</label><br>
            <input type="text" id="niveauEtude" name="niveauEtude"><br>
            <label for="ecole">Ecole:</label><br>
            <input type="text" id="ecole" name="ecole"><br>
            <label for="ville">Ville:</label><br>
            <input type="text" id="ville" name="ville"><br>
            <label for="AncienPassword">Ancien mot de passe:</label><br>
            <input type="password" id="AncienPassword" name="AncienPassword"><br>
            <label for="password">Nouveau mot de passe:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirm_password">Confirmer nouveau mot de passe:</label><br>
            <input type="password" id="confirm_password" name="confirm_password"><br>
            <input type="submit" value="Valider">
        </form>
    </div>
</div>


    <?php
    
    if ($infos[0]['type'] == "Etudiant") {
      
    ?>
        <div class="info etudiant">
            <h2> Informations : </h2>
            <h3> Vous êtes un étudiant </h3>
            <h3> Vous n'avez pas encore de groupe </h3>
        </div>


<?php
    }

} 
// <?php
// else {
//     header('Location: /index.php');
// }
// ?>