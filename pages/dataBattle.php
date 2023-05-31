<link rel="stylesheet" href="styles/component/evenements.css" />
<div class="data-event">
<?php


    if(isset($_GET['battle'])){
        $id = $_GET['battle'];
    }
    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }

    if (isset($_SESSION['email'])){
        $user = getUser($_SESSION['email']);
    }
    
    $battle = getEvenementbyID($id);
    $projet = getProjetData($id);
    $gestionnaires = getSuperviseur($projet[0]['nomProjet']);
    $podium = getPodium($id);


    echo '<h1 class="data-name">'. $battle['nomEvenement'] . '</h1>';

    echo '<p class="date">'. $battle['dateD'].' - '.$battle['dateF'].'</p>';


    // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
    if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $battle['nomEvenement']) ) ) ) {
        echo '          <a href="/?page=syntheseBattle&battle='.$battle['idEvenement'].'"> ';
        echo '              <button name="gestion"> Synthèse de la battle </button> ';
        echo '          </a>';
    }


    echo '  <div class=projet>';

    echo '      <div class = "en-tete">';

    echo '          <div class = "desc">';
    echo '              <div class = "title-projet">';
    echo '                  <h2>'. $projet[0]['nomProjet'] . '</h2>';
    echo '              </div>';

    echo '              <div class = "description">';
    echo                    $projet[0]['description'];
    echo '              </div>';
    echo '          </div>';

    echo '      </div>';

    echo '      <div class=image-projet>';
    echo '          <img src="'.$projet[0]['imageEvent'].'" alt="'.$projet[0]['nomEvenement'].'">';
    echo '      </div>';



    echo '      <div class="contact-projet">';
    echo '          <h3> Coordonnées contact </h3>';

    foreach ($gestionnaires as $gestionnaire){
        echo '      <div class = "contact-gestionnaire">';
        echo '          <p>'.$gestionnaire['prenomUtilisateur'].' ' . $gestionnaire['nomUtilisateur'].'</p>';
        echo '          <p> Mail : ' .$gestionnaire['email'] .' Tel : '. $gestionnaire['numeroTel'] .'</p>';
        echo '      </div>';
    }
    echo '      </div>';

    echo '      <div class="ressources-projet">';
    echo '          <h3> Ressources du projet </h3>';
    echo '          <p>URL d\'accès aux fichiers de description et des données du data challenge: </p>';
    echo '          <a href ='.$projet[0]['urlFichier'].'>Description du projet</a>';
    echo '          <p>URL vidéo de présentation du projet.</p>';
    echo '          <a href ='.$projet[0]['urlVideo'].'>Vidéo de présentation du projet</a>';
    echo '      </div>';

    echo '  </div>';

    echo ' 
            <h3 id=podium-title> Podium </h3> 
            <div id="podium">




                <div id="deuxieme">

                    <p>'. $podium[1]['nomEquipe'] .'</p>
                    <p>'. $podium[1]['totalNotes'] .' points</p>
                </div>

                <div id="premier">
                    <p>'. $podium[0]['nomEquipe'] .'</p>
                    <p>'. $podium[0]['totalNotes'] .' points</p>
                </div>
                
                <div id="troisieme">
                    <p>'. $podium[2]['nomEquipe'] .'</p>
                    <p>'. $podium[2]['totalNotes'] .' points</p>
                </div>
            </div>
            ';

            
?>
</div>



<script src="scripts/manageEvenements.js" defer></script>