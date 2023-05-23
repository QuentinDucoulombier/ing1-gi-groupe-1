<?php
require('accueil.php');

?>

<body>
    <div class="formInscription">

        <h2>Inscription</h2>

        <form id="modifierForm" action="../action/verif_signin.php" method="POST">

            <div class = "mail">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class = "prenom">
                <label for="prenomUtilisateur">Prénom:</label>
                <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" required>
            </div>

            <div class = "nomUtilisateur">
                <label for="nomUtilisateur">Nom:</label>                
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" required>
            </div>

            <div class = "numeroTel">
                <label for="numeroTel">Numéro de téléphone:</label>
                <input type="tel" id="numeroTel" name="numeroTel" required>
            </div>
            
            <div class = "niveauEtude">
                <label for="niveauEtude">Niveau d'étude:</label>
                <input type="text" id="niveauEtude" name="niveauEtude" required>
            </div>
            
            <div class = "ecole">
                <label for="ecole">Ecole:</label>
                <input type="text" id="ecole" name="ecole" required>
            </div>
            
            <div class = "ville">
                <label for="ville">Ville:</label>            
                <input type="text" id="ville" name="ville" required>
            </div>
            
            <div class = "motDePasse">
                <label for="motDePasse">Mot de passe:</label>
                <input type="password" id="motDePasse" name="motDePasse" required>
            </div>
            
            <div class = "confirm_mdp">
                <label for="confirm_motDePasse">Confirmer mot de passe:</label><br>
                <input type="password" id="confirm_motDePasse" name="confirm_motDePasse" required>
            </div>

            <div class="submit">
                <input type="submit" value="S'inscrire">
            </div>

        </form>
    </div>
</body>
