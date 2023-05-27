<?php
    session_start();
    require('bdd.php');

    $user = getUser($_SESSION['email']);

    $idUser = $user[0]["idUtilisateur"];
    $_SESSION['idUser'] = $idUser;
    $response = verifEquipe($idUser);
    /*
    En gros s'il est dans une equipe et qu'il est capitaine on lui propose de gerer l'equipe
    S'il n'est dans aucune equipe on lui propose de cree une nouvelle equipe
    Sinon juste lui donner la liste des membres de l'equipes
    */
    if(empty($response)) {
        header('Location: /?page=createTeam');
    } elseif($response["idCapitaine"] == $idUser) {
        $_SESSION['idTeam'] = $response["idEquipe"];
        header('Location: /?page=manageTeam');
    } else {
        header('Location: /?page=viewTeam');
    }
    




?>