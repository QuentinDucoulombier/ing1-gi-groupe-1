<!DOCTYPE html>

<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email


    $infos = getUser($email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>

    <html lang="en">
    <!--
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/profil.css" />
        <script defer src="../scripts/profil.js"></script>


        <title>Profil</title>
    </head>
-->

    <table>
        <tr>
            <th>Prénom</th>
            <td><?php echo $infos[0]['prenomUtilisateur']; ?></td>
            <td><p id="prenomError" style="display: none; color: red;">Veuillez entrer un prénom valide</p></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $infos[0]['nomUtilisateur']; ?></td>
            <td><p id="nomError" style="display: none; color: red;">Veuillez entrer un nom valide</p></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $infos[0]['email']; ?></td>
            <td><p id="emailError" style="display: none; color: red;">Veuillez entrer une adresse email valide</p></td>
        </tr>
        <tr>
            <th>Numéro de téléphone</th>
            <td><?php echo $infos[0]['numeroTel']; ?></td>
            <td><p id="numeroTelError" style="display: none; color: red;">Veuillez entrer un numéro de téléphone valide</p></td>
        </tr>
        <tr id="Ancien_MotDePasse_Admin">
            <th>Ancien mot de passe</th>
            <td></td>
            <td><p id="ancienMotDePasseError" style="display: none; color: red;">Veuillez entrer le bon ancien mot de passe</p></td>
        </tr>
        <tr id="MotDePasse_Admin">
            <th>Mot de passe</th>
            <td></td>
            <td><p id="motDePasseError" style="display: none; color: red;">Veuillez entrer un mot de passe valide</p></td>
        </tr>
        <tr id="Confirmer_MotDePasse_Admin">
            <th>Confirmer mot de passe</th>
            <td></td>
            <td><p id="confirmMotDePasseError" style="display: none; color: red;">Veuillez confirmer votre mot de passe</p></td>
        </tr>
        <tr>
            <th>Modifier</th>
            <td><button onclick="toggleEditAdmin(this)" data-mdp="<?php echo $infos[0]['motDePasse']; ?>"  data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
        </tr>
    </table>



    </html>


    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}
?>