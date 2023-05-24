<?php
require('accueil.php');

?>

<body>
    <div class="formInscription">

        <h2>Inscription</h2>

        <form id="modifierForm" action="../action/verif_signin.php" method="POST">

            <div class = "mail">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <div class = "prenom">
                <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" placeholder="Prénom" required>
            </div>

            <div class = "nomUtilisateur">
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" placeholder="Nom" required>
            </div>

            <div class = "numeroTel">
                <input type="tel" id="numeroTel" name="numeroTel" placeholder="Numéro de téléphone" required>
            </div>
            
            <div class = "niveauEtude">
                <input type="text" id="niveauEtude" name="niveauEtude" placeholder="Niveau d'étude" required>
            </div>
            
            <div class = "ecole">
                <input type="text" id="ecole" name="ecole" placeholder="Ecole" required>
            </div>
            
            <div class = "ville">
                <input type="text" id="ville" name="ville" placeholder="Ville" required>
            </div>
            
            <div class = "motDePasse">
                <input type="password" id="motDePasse" name="motDePasse" placeholder="Mot de passe" required>
            </div>
            
            <div class = "confirm_mdp">
                <input type="password" id="confirm_motDePasse" name="confirm_motDePasse" placeholder="Confirmer mot de passe" required>
            </div>

            <div class="submit">
                <input type="submit" value="S'inscrire">
            </div>

        </form>
    </div>
</body>

