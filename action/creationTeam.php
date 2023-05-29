<?php
    /*FIXME:Ca marche pas*/
    session_start();
    require('bdd.php');

    $nomEquipe = $_POST["nomEquipe"];
    $idCapitaine = $_SESSION['idUser'];
    $idProjet = $_SESSION['idProjet'];
    createTeam($nomEquipe, $idCapitaine, $idProjet);
    header('Location: /?page=manageTeam');



?>