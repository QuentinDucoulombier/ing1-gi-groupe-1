<?php
session_start();

include "class/database_login.php";
include "class/bdd.php";
include "class/router.php";

if (!isset($_GET["page"])){
    $_GET["page"] = "acceuil";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
    
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
        <title>Titre - <?php echo router::get_page(); ?></title>
        <link rel="stylesheet" href="styles/global.css" />

        <link rel="stylesheet" href="styles/component/header.css" />
        <link rel="stylesheet" href="styles/component/footer.css" />
        <link rel="stylesheet" href="styles/component/nav.css" />

        <script src="scripts/main.js" defer></script>
    </head>
    <body>
    
        <div id="app">
    
            <div id="header">
                <?php include "component/header.php"; ?>
            </div>
            <div id="middle">
                <div id="nav">
                    <?php include "component/nav.php"; ?>
                </div>
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
</html