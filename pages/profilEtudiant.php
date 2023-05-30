<!DOCTYPE html>

<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email


    $infos = getUser($email);

    ?>
    
    <html lang="en">
   
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/profil.css" />


        <title>Profil</title>
    </head>

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

        <tr id="Ancien_MotDePasse_Etudiant">
            <th>Ancien mot de passe</th>
            <td></td>
        </tr>

        <tr>
            <th>Mot de passe</th>
            <td><?php echo $infos[0]['motDePasse']; ?></td>
        </tr>
        <tr id="Confirmer_MotDePasse_Etudiant">
            <th>Confirmer mot de passe</th>
            <td><?php echo $infos[0]['motDePasse']; ?></td>
        </tr>
        <tr>
            <td><button onclick="toggleEditProfilEtudiant(this)" data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
        </tr>
    </table>
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

    </html>

    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}
?>
 