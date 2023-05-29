<?php
    if (isset($_SESSION['email'])){

        $user = getUser($_SESSION['email']);

        if(isset($_GET['challenge'])){
            $idChallenge = $_GET['challenge'];
        }

        $challenge = getEvenementbyID($idChallenge);
        $equipes = getEquipesEvenement($idChallenge);
        $projets = getProjetsEvenement($idChallenge);

        // La page s'affiche uniquement si l'utilisateur est un administrateur ou un gestionnaire du data Challenge
        if ($user[0]['type'] == "Administrateur") {
            echo '<h1>'. $challenge['nomEvenement'] . '</h3>';
            echo '<p>'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';

            echo '<h3> Liste des projets rattachés : </h3>';

            foreach ($projets as $projet){
                echo ' <div id="liste-projets">';
                echo '      <a class ="more-link" href="/?page=syntheseProjet&projet='.$projet['idProjetData'].'"> '.$projet['nomProjet'].' </a>';
                echo ' </div>';
            }

            echo '<h3> Liste des équipes rattachées : </h3>';

            foreach ($equipes as $equipe){
                echo ' <div id="liste-equipes">';
                echo    $equipe['nomEquipe'];
                echo ' </div>';
            }

        }
    }
?>