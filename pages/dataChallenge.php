<?php


if(isset($_GET['challenge'])){
        $nomChallenge = $_GET['challenge'];
    }

    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }

    $projet = getProjetData($nomChallenge);

    echo ' <div class = "projetData">';
    echo $projet[0]['nomEvenement'];
    echo ' </div>';
            
?>