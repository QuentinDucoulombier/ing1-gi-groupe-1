<?php
    session_start();
    require('bdd.php');

    $nomEquipe = $_POST["nomEquipe"];
    $idCapitaine = $_SESSION['idUser'];
    $idProjet = $_SESSION['idProjet'];
    createTeam("\"".$nomEquipe."\"", $idCapitaine, $idProjet);
    $result = getIdTeam($idCapitaine,$idProjet);
    
    $idTeam = $result["idEquipe"];
    addUserTeam($idCapitaine,$idTeam);
    $response = verifEquipe($idCapitaine,$idProjet);
    $_SESSION['idTeam'] = $response["idEquipe"];
    header('Location: /?page=manageTeam');

?>