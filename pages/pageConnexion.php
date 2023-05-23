<?php
require('accueil.php');

?>

<!DOCTYPE html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/pageConnexion.css" />
        <title>Connexion</title>
</head>

<body>
    <div class="formConnexion">
        <h2>Connexion</h2>
        <form id="modifierForm" action="../action/connexion.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="motDePasse">Mot de passe:</label><br>
        <input type="password" id="motDePasse" name="motDePasse" required><br>
        <input type="submit" value="Se connecter">
        </form>
    </div>
</body>