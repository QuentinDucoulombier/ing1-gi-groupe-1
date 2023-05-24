<!DOCTYPE html>
<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email
    
    
    $infos = getUser($email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>
    <html lang="en">
<!--
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/profil.css" />
        <script defer src="../scripts/profil.js"></script>


        <title>Profil</title>
    </head>
-->
 
    <body>

        <div class="prenomUtilisateur">
            <h2> Nom : </h2>
            <?php
            echo "<h2>" . $prenomUtilisateur . "</h2>";
            ?>
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

        <div class="entreprise">
            <h2> Entreprise : </h2>
            <?php
            echo "<h2>" . $infos[0]['nomEntreprise'] . "</h2>";
            ?>
        </div>

        <div class="dateFinUtilisateur">
            <h2> Date de fin d'utilisateur : </h2>
            <?php
            $dateFinUtilisateur = date('d F Y', strtotime($infos[0]['dateFinUtilisateur']));
            echo "<h2>" . $dateFinUtilisateur . "</h2>";
            ?>, 
        </div>
        
        <div class="modifier">
            <li class="buttonC" class="boutonmodifier">
                <div onclick="openModifierModal()">Modifier vos informations</div>
            </li>

        </div>

        <div class="projet_gestionnaire">
            <h2> Vos projets à gérer: </h2>

        </div>
    
    </body>

    </html>

    <div id="modifierModal">
    <div class="modal-content">
        <span id="closeModifier" onclick="closeModifierModal()">&times;</span>
        <h2>Modifier vos informations</h2>
        <form id="modifierForm" action="../action/edit_profil.php" method="POST">
            <label for="prenomUtilisateur">Prénom:</label><br>
            <input type="text" id="prenomUtilisateur" name="prenomUtilisateur"><br>
            <label for="nomUtilisateur">Nom:</label><br>
            <input type="text" id="nomUtilisateur" name="nomUtilisateur"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="numeroTel">Numéro de téléphone:</label><br>
            <input type="tel" id="numeroTel" name="numeroTel"><br>
            <label for="nomEntreprise">Entreprise:</label><br>
            <input type="text" id="nomEntreprise" name="nomEntreprise"><br>
            <label for="dateFinUtilisateur">Date de fin d'utilisateur:</label><br>
            <input type="date" id="dateFinUtilisateur" name="dateFinUtilisateur"><br>
            <label for="AncienPassword">Ancien mot de passe:</label><br>
            <input type="password" id="AncienPassword" name="AncienPassword"><br>
            <label for="password">Nouveau mot de passe:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirm_password">Confirmer nouveau mot de passe:</label><br>
            <input type="password" id="confirm_password" name="confirm_password"><br>
            <input type="submit" value="Valider">
        </form>
    </div>



    
<?php
} 

else {
    echo 'error';
//     header('Location: /index.php');
}
?>