<!DOCTYPE html>

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
                <td><?php echo $infos[0]['prenomUtilisateur']; ?></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td><?php echo $infos[0]['nomUtilisateur']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $infos[0]['email']; ?></td>
            </tr>
            <tr>
                <th>Numéro de téléphone</th>
                <td><?php echo $infos[0]['numeroTel']; ?></td>
            </tr>
            <tr>
                <th>Niveau d'étude</th>
                <td><?php echo $infos[0]['niveauEtude']; ?></td>
            </tr>
            <tr>
                <th>Ecole</th>
                <td><?php echo $infos[0]['ecole']; ?></td>
            </tr>
            <tr>
                <th>Ville</th>
                <td><?php echo $infos[0]['ville']; ?></td>
            </tr>

            <tr>
                <th>Mot de passe</th>
                <td><?php echo $infos[0]['motDePasse']; ?></td>
            </tr>
            <tr>
                <th>Confirmer mot de passe</th>
                <td><?php echo $infos[0]['motDePasse']; ?></td>
            </tr>
            <tr>
                <th>Modifier</th>
                <td><button onclick="toggleEditProfilEtudiant(this)" data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
            </tr>
        </table>
    </div>
    <div class="projects">
        <h2>Mes Projets</h2>

        <h2>Mon équipe</h2>
        <?php
        // Appel de la fonction pour récupérer les équipes de l'utilisateur
        $resultats = getMembreEquipe($email);


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
    //     header('Location: /index.php');
}
?>
 