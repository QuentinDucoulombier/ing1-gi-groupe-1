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
            echo '<h1 class="data-name">'. $challenge['nomEvenement'] . '</h3>';
            echo '<p class="date">'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';

        if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
            echo '          <div class="synthese"';
            echo '          <a href="/?page=modifierEvenement&evenement='.$idChallenge.'"> ';
            echo '              <button name="creation"> Modifier le challenge </button> ';
            echo '          </a>';
        }


            // Si l'utilisateur est un administrateur peut supprimer le challenge
            if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
                echo '              <button name="supprimer" id-event="'.$challenge['idEvenement'].'" onclick="supprimerEvent(this)"> Supprimer le challenge </button>';
            

                echo '<h3> Liste des projets rattachés : </h3>';
                foreach ($projets as $projet){
                    echo ' <div id="liste-projets">';
                    echo '      <a class ="more-link" href="/?page=syntheseProjet&projet='.$projet['idProjetData'].'"> <button name="gestion"> Syntèse '.$projet['nomProjet'].' </button>  </a>';
                    echo ' <div class="project-name"';


                        if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
                            echo '          <a href="/?page=modifierProjet&projet='.$projet['idProjetData'].'"> ';
                            echo '              <button name="creation"> Modifier le projet </button> ';
                            echo '          </a>';
                        }

                        // Si l'utilisateur est un administrateur peut supprimer le challenge
                        if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
                            echo '              <button name="supprimer" id-projet="'.$projet['idProjetData'].'" onclick="supprimerProjet(this)"> Supprimer le projet </button>';
                        }
                    }
                    echo '<div><button class="statistique" onclick="window.location.href=`./?page=statglobale&ProjetData='.$projets[0]["idProjetData"].'`">Statistiques projets</button></div>';

                    echo '          </div>';
                    echo ' </div>';
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

                        <div class="messages">
                            <form action="/?page=viewMessageTeam" method="POST">
                                <?php
                                    echo '<input type="hidden"  name="idTeam" value="'.$equipe['idEquipe'].'"/>'
                                ?>
                                <input type="submit" value="Voir les messages"/>
                            </form>
                        </div>
                        <div class="sendGroupMessage">
                            <form action="/?page=groupeMessage" method="POST">
                                <?php
                                    echo '<input type="hidden"  name="idTeam" value="'.$equipe['idEquipe'].'"/>'
                                ?>
                                <input type="submit" value="Envoyer un message au groupe"/>
                            </form>

                        </div>
                        
                    <?php
                    }
                    ?>

                <?php
            } else{
            header ('Location: /?page=connexion');

            }
    } else {
        header ('Location: /?page=connexion');
    
    }
?>
</div>
<script src="scripts/manageEvenements.js" defer></script>