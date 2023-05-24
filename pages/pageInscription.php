<?php
require('accueil.php');

?>

<!DOCTYPE html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/pageInscription.css" />
        <title>Inscription</title>
</head>

<body>
    <div class="formInscription">
        <h2>Inscription</h2>
        <form id="modifierForm" action="../action/inscription.php" method="POST">
        <label for="email2">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="prenomUtilisateur">Prénom:</label><br>
        <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" required><br>
        <label for="nomUtilisateur">Nom:</label><br>
        <input type="text" id="nomUtilisateur" name="nomUtilisateur" required><br>
        <label for="numeroTel">Numéro de téléphone:</label><br>
        <input type="tel" id="numeroTel" name="numeroTel" required><br>
        <label for="niveauEtude">Niveau d'étude:</label><br>
        <input type="text" id="niveauEtude" name="niveauEtude" required><br>
        <label for="ecole">Ecole:</label><br>
        <input type="text" id="ecole" name="ecole" required><br>
        <label for="ville">Ville:</label><br>
        <input type="text" id="ville" name="ville" required><br>
        <label for="motDePasse">Mot de passe:</label><br>
        <input type="password" id="motDePasse" name="motDePasse" required><br>
        <label for="confirm_motDePasse">Confirmer mot de passe:</label><br>
        <input type="password" id="confirm_motDePasse" name="confirm_motDePasse" required><br>
        <input type="submit" value="S'inscrire">
        </form>
    </div>
</body>

