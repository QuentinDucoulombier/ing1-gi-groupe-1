<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email
    
    
    $infos = getUser($email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>
    



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

</div>

<div class="projet_etudiant">
    <h2> Vos projets : </h2>

</div>
    

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

        <div class="radioniveauEtude">
        <label for="niveauEtude" class="titreniveauEtude">niveauEtude</label>
        <input type="radio" id="niveauEtude" name="niveauEtude" value="L1" > L1 
        <input type="radio" id="niveauEtude" name="niveauEtude" value="L2" > L2
        <input type="radio" id="niveauEtude" name="niveauEtude" value="L3" > L3
        <input type="radio" id="niveauEtude" name="niveauEtude" value="M1" > M1
        <input type="radio" id="niveauEtude" name="niveauEtude" value="M2" > M2
        <input type="radio" id="niveauEtude" name="niveauEtude" value="D" > D

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



    
<?php
} 

else {
    echo 'error';
//     header('Location: /index.php');
}
?>