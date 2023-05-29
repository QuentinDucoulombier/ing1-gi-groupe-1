<?php
    if (isset($_SESSION['email'])){

        $user = getUser($_SESSION['email']);

        if(isset($_GET['projet'])){
            $idProjet = $_GET['projet'];
        }

        $challenge = getEvenementbyID($idChallenge);
        $equipes = getEquipesProjet($idProjet);

        // La page s'affiche uniquement si l'utilisateur est un administrateur ou un gestionnaire du data Challenge
        if ($user[0]['type'] == "Administrateur") {
            echo '<h1>'. $challenge['nomEvenement'] . '</h3>';
            echo '<p>'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';


            echo '<h3> Liste des équipes rattachées : </h3>';

            foreach ($equipes as $equipe){
                echo ' <div id="liste-equipes">';
                echo    $equipe['nomEquipe'];
                echo ' </div>';
            }

        }
    }
?>