<div class="formConnexion">

    <h2>Connexion</h2>

    <form id="modifierForm" action="../action/verif_login.php" method="POST">

        <div class="mail">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="motDePasse">
            <label for="motDePasse">Mot de passe:</label>
            <input type="password" id="motDePasse" name="motDePasse" required>
        </div>

        <div class="submit">
            <input type="submit" value="Se connecter">
        </div>

    </form>
</div>