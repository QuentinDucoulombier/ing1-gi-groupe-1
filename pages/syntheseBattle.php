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
        if ($user[0]['type'] == "Administrateur") {
            echo '<h1>'. $battle['nomEvenement'] . '</h3>';
            echo '<p>'. $battle['dateD'].' - '.$battle['dateF'].'</p>';

            echo '<h3> Projet rattaché : </h3>';

            echo ' <div id="liste-projets">';
            echo '      <a class ="more-link" href="/?page=syntheseProjet&projet='.$projets[0]['idProjetData'].'"> '.$projets[0]['nomProjet'].' </a>';
            echo ' </div>';

            echo '<h3> Liste des équipes rattachées : </h3>';

            foreach ($equipes as $equipe){
                echo ' <div id="liste-equipes">';
                echo    $equipe['nomEquipe'];
                echo ' </div>';
            }?>

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
                        <a href="">
                            <button name="supprimer"> Supprimer </button>
                        </a>

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