<link rel="stylesheet" href="styles/component/synthese.css" />
<script src="scripts/manageEvenements.js" defer></script>

<?php
    if (isset($_SESSION['email'])){

        $user = getUser($_SESSION['email']);

        if(isset($_GET['battle'])){
            $idBattle = $_GET['battle'];
        }

        $battle = getEvenementbyID($idBattle);
        $equipes = getEquipesEvenement($idBattle);
        $projets = getProjetsEvenement($idBattle);

        // La page s'affiche uniquement si l'utilisateur est un administrateur ou un gestionnaire du data Challenge
        if ($user[0]['type'] == "Administrateur"|| ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $battle['nomEvenement']) )) {
            echo '<h1>'. $battle['nomEvenement'] . '</h3>';
            echo '<p>'. $battle['dateD'].' - '.$battle['dateF'].'</p>';

            if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
                echo '          <a href="/?page=modifierEvenement&evenement='.$idBattle.'"> ';
                echo '              <button name="creation"> Modifier la battle </button> ';
                echo '          </a>';
            }
             // Si l'utilisateur est un administrateur peut supprimer le challenge
             if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")) ) {
                echo '              <button name="supprimer" id-event="'.$idBattle.'" onclick="supprimerEvent(this)"> Supprimer la battle </button>';
            }

            echo '<h3> Projet rattaché : </h3>';

            echo ' <div id="liste-projets">';
            echo        $projets[0]['nomProjet'];
            if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
                echo '          <a href="/?page=modifierProjet&projet='.$projet[0]['idProjetData'].'"> ';
                echo '              <button name="creation"> Modifier le projet </button> ';
                echo '          </a>';
            }
            echo ' </div>';

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

                    <div class="reponses-questionnaire">
                        <p> Réponses de l'équipe :</p>

                        <?php
                        for($i=1; $i<=4; $i++){?>
                                
                            <?php
                            if (isQuestionnaire($idBattle, $i)){
                                $questionnaire = getQuestionnaire($idBattle, $i);?>
                                <a href="/?page=noteQuestionnaire&dataBattle=<?php echo $idBattle?>&equipe=<?php echo $equipe['idEquipe'] ?>&questionnaire=<?php echo $questionnaire['idQuestionnaire'] ?>">
                                    <button name="reponses"> Questionnaire n°<?php echo $i ?> </button>
                                </a>
                            <?php 
                            } 
                            ?>
                            
                        <?php 
                        } 
                        ?>

                    </div>

                </div>
                
            <?php
            }
            ?>

            <h3> Liste des questionnaires rattachées : </h3>

            <div id="liste-questionnaires">

                <?php
                for($i=1; $i<=4; $i++){?>

                    <div class="questionnaire">
                        <p> Questionnaire n°<?php echo $i ?>

                        <?php
                        if (!isQuestionnaire($idBattle, $i)){?>
                            </p>
                            <a href="/?page=ajoutquestionnaire&battle=<?php echo $idBattle?>&numero=<?php echo $i?>">
                                <button name="creation"> Créer </button>
                            </a>

                        <?php 
                        } 
                        ?>
                        
                        <?php
                        if (isQuestionnaire($idBattle, $i)){
                            $questionnaire = getQuestionnaire($idBattle, $i);?>
                            du <?php echo $questionnaire['dateDebut'] . ' au ' . $questionnaire['dateFin']?> </p>
                            
                            <button name="supprimer" id-questionnaire="<?php echo $questionnaire['idQuestionnaire']; ?>" onclick="supprimerQuestionnaire(this)"> Supprimer </button>
                            

                        <?php 
                        } 
                        ?>
                    
                    </div>
                <?php 
                } 
                ?>
            </div>

        <?php
        }
    }
?>