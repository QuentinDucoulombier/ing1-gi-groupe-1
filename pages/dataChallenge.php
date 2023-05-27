<link rel="stylesheet" href="styles/component/evenements.css" />
<?php


if(isset($_GET['challenge'])){
        $id = $_GET['challenge'];
    }

    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }

    $challenge = getEvenementbyID($id);

    echo '<h1>'. $challenge['nomEvenement'] . '</h3>';
    echo '<p>'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';

    $projets = getProjetData($challenge['nomEvenement']);

    echo '<div class=liste-projet>';

    foreach ($projets as $projet){
        echo '  <div class=projet>';

        echo '      <div class = "en-tete">';

        echo '          <div class = "desc">';
        echo '              <div class = "title">';
        echo '                  <h2>'. $projet['nomProjet'] . '</h2>';
        echo '              </div>';

        echo '              <div class = "description">';
        echo                    $projet['description'];
        echo '              </div>';
        echo '          </div>';

        echo '      </div>';

        echo '          <div class=image-projet>';
        echo '              <img src="'.$projet['imageEvent'].'" alt="'.$projet['nomEvenement'].'">';
        echo '          </div>';


        $gestionnaires = getSuperviseur($projet['nomProjet']);

        echo '      <div class="contact-projet">';
        echo '          <h3> Coordonnées contact </h3>';

        foreach ($gestionnaires as $gestionnaire){
            echo '      <div class = "contact-gestionnaire">';
            echo '          <p>'.$gestionnaire['prenomUtilisateur'].' ' . $gestionnaire['nomUtilisateur'].'</p>';
            echo '          <p> Mail : ' .$gestionnaire['email'] .' Tel :'. $gestionnaire['numeroTel'] .'</p>';
            echo '      </div>';
        }
        echo '      </div>';

        echo '      <div class="ressources-projet">';
        echo '          <h3> Ressources du projet </h3>';
        echo '          <p>URL d\'accès aux fichiers de description et des données du data challenge: </p>';
        echo '          <a href ='.$projet['urlFichier'].'>Description du projet</a>';
        echo '          <p>URL vidéo de présentation du projet.</p>';
        echo '          <a href ='.$projet['urlVideo'].'>Vidéo de présentation du projet</a>';
        echo '      </div>';

        echo '  </div>';
    }
    echo '</div>';


            
?>