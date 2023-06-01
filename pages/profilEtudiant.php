

<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email


    $infos = getUser($email);

?>
    

<div class="profil">
    <div id="profil_id" class="profil_block">
        <h2>Mon Profil</h2>
        <table>
            <tr>
                <th>Prénom</th>
                <td id="prenomUtilisateur" ><?php echo $infos[0]['prenomUtilisateur']; ?></td>
                <td><p id="prenomError" style="display: none; color: red;">Veuillez entrer un prénom valide</p></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td id="nomUtilisateur"><?php echo $infos[0]['nomUtilisateur']; ?></td>
                <td><p id="nomError" style="display: none; color: red;">Veuillez entrer un nom valide</p></td>
            </tr>
            <tr>
                <th>Email</th>
                <td id="email"><?php echo $infos[0]['email']; ?></td>
                <td><p id="emailError" style="display: none; color: red;">Veuillez entrer une adresse email valide</p></td>
            </tr>
            <tr>
                <th>Numéro de téléphone</th>
                <td id="numeroTel"><?php echo $infos[0]['numeroTel']; ?></td>
                <td><p id="numeroTelError" style="display: none; color: red;">Veuillez entrer un numéro de téléphone valide</p></td>
                </tr>
            <tr>
                <th>Niveau d'étude</th>
                <td id="niveauEtude"><?php echo $infos[0]['niveauEtude']; ?></td>
                <td><p id="niveauEtudeError" style="display: none; color: red;">Veuillez entrer un niveau d'étude valide</p></td>
            </tr>
            <tr>
                <th>Ecole</th>
                <td id="ecole"><?php echo $infos[0]['ecole']; ?></td>
                <td><p id="ecoleError" style="display: none; color: red;">Veuillez entrer un nom d'école valide</p></td>
            </tr>
            <tr>
                <th>Ville</th>
                <td id="ville"><?php echo $infos[0]['ville']; ?></td>
                <td><p id="villeError" style="display: none; color: red;">Veuillez entrer un nom de ville valide</p></td>
            </tr>

        <tr id="Ancien_MotDePasse_Etudiant" class="hide">
            <th>Ancien mot de passe</th>
            <td id="AncienmotDePasse"></td>
            <td><p id="ancienMotDePasseError" style="display: none; color: red;">Veuillez entrer le bon ancien mot de passe</p></td>
        </tr>

        <tr id="MotDePasse_Etudiant" class="hide">
            <th>Mot de passe</th>
            <td id="motDePasse"></td>
            <td><p id="motDePasseError" style="display: none; color: red;">Veuillez entrer un mot de passe</p></td>
        </tr>
        <tr id="Confirmer_MotDePasse_Etudiant" class="hide">
            <th>Confirmer mot de passe</th>
            <td id="confirm_motDePasse"></td>
            <td><p id="confirmMotDePasseError" style="display: none; color: red;">Veuillez confirmer votre mot de passe</p></td>
        </tr>
        <tr>
            <td><button onclick="toggleEditProfilEtudiant(this)" data-mdp="<?php echo $infos[0]['motDePasse']; ?>" data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
        </tr>
    </table>
    </div>
    <div class="projects">
    <h2>Mes Projets</h2>
    <?php
    $projets = getProjetUser($email);

    echo "<table>";
    echo "<tbody>";
    foreach ($projets as $projet) {
        echo "<tr>";
        echo "<td>" . $projet['nomProjet'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
    <h2>Mon équipe</h2>
    <?php
    // Appel de la fonction pour récupérer les équipes de l'utilisateur
    $resultats = getEquipeUser($email);

    // Affichage du tableau
    echo "<table>";
    echo "<tbody>";
    foreach ($resultats as $resultat) {
        echo "<tr>";
        echo "<td>" . $resultat['nomEquipe'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>


        

    </div>
</div>
    <?php
} else {
    echo 'error';
}
?>
