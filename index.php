<?php
session_start();

include "action/database_login.php";
include "action/bdd.php";
include "action/router.php";

if (!isset($_GET["page"])){
    $_GET["page"] = "accueil";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">

<!--        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
        <title>Projet - <?php echo router::get_page(); ?></title>
        <link rel="stylesheet" href="styles/global.css" />

        <link rel="stylesheet" href="styles/component/header.css" />
        <link rel="stylesheet" href="styles/component/footer.css" />
        <link rel="stylesheet" href="styles/component/accueil.css" />
        <link rel="stylesheet" href="styles/component/profil.css" />
        <link rel="stylesheet" href="styles/component/form.css" />


                

        <script src="scripts/main.js" defer></script>
        <script src="scripts/gererUtilisateur.js" defer></script>
        <script src="scripts/profilAdmin.js" defer></script>
        <script src="scripts/profilGestionnaire.js" defer></script>
        <script src="scripts/profilEtudiant.js" defer></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    </head>
    <body>
    
        <div id="app">
    
            <div id="header">
                <?php include "component/header.php"; ?>
            </div>
            <div id="middle">
                <div id="content">
                    <?php

                    router::set_page();

                    ?>
                </div>
            </div>
            <div id="footer">
                <?php include "component/footer.php"; ?>
            </div>
    
        </div>
    
    </body>
</html>