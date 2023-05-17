<?php
session_start();
require('config.php');

?>
<!DOCTYPE html>

<?php

if (isset($_SESSION['id'])) {

    $id = intval($_SESSION['id']);


    $requsr = "SELECT * FROM compte WHERE id = '$id'";
    $result = mysqli_query($connexion, $requsr) or die('Pb req : ' . $requsr);
    $infos = $result->fetch_assoc();
    $nom = $infos['nom'];
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
        <div class="nomUtilisateur">
            <h2> Nom d'utilisateur : </h2>
            <?php
            echo "<h2>" . $nom . "</h2>";
            ?>
        </div>
        <div class="mdp">
            <h2> Modifier le mot de passe :</h2>
            <li class="buttonC" class="boutonmodalMdp">
                <div onclick="openMdpModal()">Modifier votre mot de passe</div>
            </li>
        </div>
    </body>

    </html>
    <div id="mdpModal" class="modal">
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
    </div>
    <?php
    $statut = "SELECT statut FROM compte WHERE id = '$id'";
    if ($statut == "etudiant") {
    ?>
        <div class="info etudiant">
            <h2> Informations : </h2>
            <h3> Vous êtes un étudiant </h3>
            <h3> Vous n'avez pas encore de groupe </h3>


<?php
    }

} 
// <?php
// else {
//     header('Location: /index.php');
// }
// ?>