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
        if (($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireInterne($user[0]['email']) )) {
            echo '<h1>'. $challenge['nomEvenement'] . '</h3>';
            echo '<p>'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';

        if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
            echo '          <a href="/?page=modifierChallenge"> ';
            echo '              <button name="creation"> Modifier le challenge </button> ';
            echo '          </a>';
        }
        // Si l'utilisateur est un administrateur peut supprimer le challenge
        if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
            echo '              <button name="supprimer" id-event="'.$challenge['idEvenement'].'" onclick="supprimerEvent(this)"> Supprimer le challenge </button>';
        }

            echo '<h3> Liste des projets rattachés : </h3>';

            foreach ($projets as $projet){
                echo ' <div id="liste-projets">';
                echo '      <a class ="more-link" href="/?page=syntheseProjet&projet='.$projet['idProjetData'].'"> <button name="gestion"> Syntèse '.$projet['nomProjet'].' </button>  </a>';
                echo ' </div>';

                // Si l'utilisateur est un administrateur peut supprimer le challenge
                if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
                    echo '              <button name="supprimer" id-projet="'.$projet['idProjetData'].'" onclick="supprimerProjet(this)"> Supprimer le projet </button>';
                }
            }

            echo '<h3> Liste des équipes rattachées : </h3>';

            foreach ($equipes as $equipe){?>
                <div id="liste-equipes">

                    <div class="nom-equipe">
                        <?php echo $equipe['nomEquipe'] ?>
                    </div>

                    <div class="messages">
                        <a href="">
                            <button name="messages"> Voir les messages </button>
                        </a>
                    </div>

                </div>
                
            <?php
            }
            ?>

        <?php
        }
        else{
        header ('Location: /?page=404');

        }
    }
    else{
    header ('Location: /?page=404');

    }
?>

<script src="scripts/manageEvenements.js" defer></script>