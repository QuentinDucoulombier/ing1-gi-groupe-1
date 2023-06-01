<?php
    session_start();
    require('../bdd.php');

    $message = $_POST["message"];
    $idUser = $_SESSION["idUser"];
    $idTeam = $_POST["idEquipe"];
    $membres = getMembreTeam($idTeam);
    if(!(empty($membres))) {

    
        foreach ($membres as $membre) {
            $idDest = $membre["idEtudiant"];
            sendMessage($idUser,$idDest,$message);
        }
    }
    header('Location: /?page=groupeMessage');
    

?>