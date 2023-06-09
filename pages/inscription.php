
 <div class="formInscription">
    <form id="modifierForm" action="../action/verif_signin.php" method="POST">
        <h2>Inscription</h2>
        <div class="mail">
            <input type="email" id="email" name="email" placeholder="Email" title="test" required>
            <p id="emailError" style="display: none; color: red;">Veuillez entrer une adresse email valide.</p>
        </div>

        <div class="prenom">
            <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" placeholder="Prénom" required>
            <p id="prenomError" style="display: none; color: red;">Veuillez entrer votre prénom.</p>
        </div>

        <div class="nomUtilisateur">
            <input type="text" id="nomUtilisateur" name="nomUtilisateur" placeholder="Nom" required>
            <p id="nomError" style="display: none; color: red;">Veuillez entrer votre nom.</p>
        </div>

        <div class="numeroTel">
            <input type="tel" id="numeroTel" name="numeroTel" placeholder="Numéro de téléphone" required>
            <p id="numeroTelError" style="display: none; color: red;">Veuillez entrer un numéro de téléphone valide.</p>
        </div>

        <div class="radioniveauEtude">
            <input type="radio" id="L1" name="niveauEtude" value="L1"><label for="L1">L1</label>
            <input type="radio" id="L2" name="niveauEtude" value="L2"><label for="L2">L2</label>
            <input type="radio" id="L3" name="niveauEtude" value="L3"><label for="L3">L3</label>
            <input type="radio" id="M1" name="niveauEtude" value="M1"><label for="M1">M1</label>
            <input type="radio" id="M2" name="niveauEtude" value="M2"><label for="M2">M2</label>
            <input type="radio" id="D" name="niveauEtude" value="D"><label for="D">D </label>
            <p id="niveauEtudeError" style="display: none; color: red;">Veuillez sélectionner votre niveau d'étude.</p>
        </div>

        <div class="ecole">
            <input type="text" id="ecole" name="ecole" placeholder="Ecole" required>
            <p id="ecoleError" style="display: none; color: red;">Veuillez entrer le nom de votre école.</p>
        </div>

        <div class="ville">
            <input type="text" id="ville" name="ville" placeholder="Ville" required>
            <p id="villeError" style="display: none; color: red;">Veuillez entrer le nom de votre ville.</p>
        </div>

        <div class="motDePasse">
            <input type="password" id="motDePasse" name="motDePasse" placeholder="Mot de passe" required>
            <p id="motDePasseError" style="display: none; color: red;">Veuillez entrer un mot de passe.</p>
        </div>

        <div class="confirm_mdp">
            <input type="password" id="confirm_motDePasse" name="confirm_motDePasse" placeholder="Confirmer mot de passe" required>
            <p id="confirmMotDePasseError" style="display: none; color: red;">Veuillez confirmer votre mot de passe.</p>
        </div>

        <div class="submit">
            <input type="submit" value="S'inscrire" onclick="return validateForm()">
        </div>
    </form>
</div>
