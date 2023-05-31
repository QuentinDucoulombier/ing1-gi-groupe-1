<?php
    if (isset($_SESSION['email'])){

        $user = getUser($_SESSION['email']);

        if(isset($_GET['projet'])){
            $idProjet = $_GET['projet'];
        }

        $challenge = getEvenementbyProjet($idProjet);
        $equipes = getEquipesProjet($idProjet);
        $projet = getProjetbyID($idProjet);

        // La page s'affiche uniquement si l'utilisateur est un administrateur ou un gestionnaire du projet
        if ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjetData($user[0]['email'], $idProjet) ) || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireInterne($user[0]['email'])))  {
            echo '<h1>'. $challenge['nomEvenement'] . '</h3>';
            echo '<p>'. $challenge['dateDebut'].' - '.$challenge['dateFin'].'</p>';
            echo '<h2>'. $projet['nomProjet'] . '</h2>';

            if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
                echo '          <a href="/?page=modifierProjet&projet='.$projet['idProjetData'].'"> ';
                echo '              <button name="creation"> Modifier le projet </button> ';
                echo '          </a>';
            }

            // Si l'utilisateur est un administrateur peut supprimer le challenge
            if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
                echo '              <button name="supprimer" id-projet="'.$projet['idProjetData'].'" onclick="supprimerProjet(this)"> Supprimer le projet </button>';
            }


            echo '<h3> Liste des équipes rattachées : </h3>';

            foreach ($equipes as $equipe){?>
                <div id="liste-equipes">

                    <div class="nom-equipe">
                        <?php echo $equipe['nomEquipe'] ?>
                    </div>

                    <div class="messages">
                        <form action="/?page=viewMessageTeam" method="POST">
                            <?php
                                echo '<input type="hidden"  name="idTeam" value="'.$equipe['idEquipe'].'"/>'
                            ?>
                            <input type="submit" value="Voir les messages"/>
                        </form>
                    </div>

                </div>
                
            <?php
            }
            

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