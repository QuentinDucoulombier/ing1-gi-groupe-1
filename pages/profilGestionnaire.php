<!DOCTYPE html>

<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email


    $infos = getUser($email);

    ?>

<div class="profil">
    <div id="profil_id" class="profil_block">
        <h1>Profil</h1>
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
                <th>Nom de l'entreprise</th>
                <td><?php echo $infos[0]['nomEntreprise']; ?></td>
            </tr>
            <tr>
                <th>Date de début</th>
                <td><?php echo $infos[0]['dateDebutUtilisateur']; ?></td>
            </tr>
            <tr>
                <th>Date de fin</th>
                <td><?php echo $infos[0]['dateFinUtilisateur']; ?></td>
            </tr>

            <tr id="Ancien_MotDePasse_Gestionnaire" class="hide">
                <th>Ancien mot de passe</th>
                <td></td>
            </tr>

            <tr id="MotDePasse_Gestionnaire" class="hide">
                <th>Mot de passe</th>
                <td><?php echo $infos[0]['motDePasse']; ?></td>
            </tr>
            <tr id="Confirmer_MotDePasse_Gestionnaire" class="hide">
                <th>Confirmer mot de passe</th>
                <td><?php echo $infos[0]['motDePasse']; ?></td>
            </tr>
            <tr>
                <td><button onclick="toggleEditProfilGestionnaire(this)" data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
            </tr>
        </table>
    </div>
    <div class="projects">
    <h2>Mes projets à gérer</h2>
    <?php
    // Appel de la fonction pour récupérer les équipes de l'utilisateur
    $resultats = getGestionnaireProjet(['nomUtilisateur']);

    // Affichage du tableau
    echo "<table>";
    echo "<body>";
    foreach ($resultats as $resultat) {
        echo "<tr>";
        echo "<td>" . $resultat['nomProjet'] . "</td>";
        echo "</tr>";
    }
    echo "</body>";
    echo "</table>";
    ?>



</div>

    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}