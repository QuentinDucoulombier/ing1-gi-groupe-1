<?php
    session_start();
    require('bdd.php');
    suppTeam($_SESSION["idTeam"]);
    echo "Vous venez de supprimer l'équipe !";

?>