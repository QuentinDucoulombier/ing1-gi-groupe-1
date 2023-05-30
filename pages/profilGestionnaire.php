<!DOCTYPE html>
<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email
    
    
    $infos = getUser($email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>

<div class="profil_block">
    <div class="prenomUtilisateur profil">
        <h2> Nom : </h2>
        <?php
        echo "<h2>" . $prenomUtilisateur . "</h2>";
        ?>
    </div>

    <div class="nomUtilisateur profil">
        <h2> Prénom : </h2>
        <?php
        echo "<h2>" . $infos[0]['nomUtilisateur'] . "</h2>";
        ?>
    </div>

    <div class="email profil">
        <h2> Email : </h2>
        <?php
        echo "<h2>" . $infos[0]['email'] . "</h2>";
        ?>
    </div>

    <div class="numeroTel profil">
        <h2> Numéro de téléphone : </h2>
        <?php
        echo "<h2>" . $infos[0]['numeroTel'] . "</h2>";
        ?>
    </div>

    <div class="entreprise profil">
        <h2> Entreprise : </h2>
        <?php
        echo "<h2>" . $infos[0]['nomEntreprise'] . "</h2>";
        ?>
    </div>

    <div class="dateFinUtilisateur profil">
        <h2> Date de fin d'utilisateur : </h2>
        <?php
        echo "<h2>" . $infos[0]['dateFinUtilisateur'] . "</h2>";
        ?>
    </div>

    <div class="modifier profil">
        <li class="buttonC" class="boutonmodifier">
            <div onclick="openModifierModal()">Modifier vos informations</div>
        </li>

    </div>

    <div class="projet_gestionnaire profil">
        <h2> Vos projets à gérer: </h2>

    </div>
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