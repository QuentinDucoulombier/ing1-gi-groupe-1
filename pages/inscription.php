
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

<script>
    function validateForm() {
        var email = document.getElementById("email").value;
        var prenom = document.getElementById("prenomUtilisateur").value;
        var nom = document.getElementById("nomUtilisateur").value;
        var numeroTel = document.getElementById("numeroTel").value;
        var niveauEtude = document.querySelector('input[name="niveauEtude"]:checked');
        var ecole = document.getElementById("ecole").value;
        var ville = document.getElementById("ville").value;
        var motDePasse = document.getElementById("motDePasse").value;
        var confirmMotDePasse = document.getElementById("confirm_motDePasse").value;

        var valid = true;

        if (!email) {
            document.getElementById("emailError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("emailError").style.display = "none";
        }

        if (!prenom) {
            document.getElementById("prenomError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("prenomError").style.display = "none";
        }

        if (!nom) {
            document.getElementById("nomError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("nomError").style.display = "none";
        }

        if (!numeroTel) {
            document.getElementById("numeroTelError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("numeroTelError").style.display = "none";
        }

        if (!niveauEtude) {
            document.getElementById("niveauEtudeError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("niveauEtudeError").style.display = "none";
        }

        if (!ecole) {
            document.getElementById("ecoleError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("ecoleError").style.display = "none";
        }

        if (!ville) {
            document.getElementById("villeError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("villeError").style.display = "none";
        }

        if (!motDePasse) {
            document.getElementById("motDePasseError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("motDePasseError").style.display = "none";
        }

        if (motDePasse !== confirmMotDePasse) {
            document.getElementById("confirmMotDePasseError").style.display = "block";
            valid = false;
        } else {
            document.getElementById("confirmMotDePasseError").style.display = "none";
        }

        return valid;
    }
</script>

