<?php


if(isset($_GET['challenge'])){
        $nomChallenge = $_GET['challenge'];
    }

    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }

    echo '<h1>'. $nomChallenge . '</h3>';
    echo '<p>'. $nomChallenge . '</p>';

    $projets = getProjetData($nomChallenge);

    echo '<div class=projet>';

    foreach ($projets as $projet){
        echo ' <div class = "title">';
        echo '      <h2>'. $projet[0]['nomEvenement'] . '</h2>';
        echo ' </div>';
        echo ' <div class = "description">';
        echo        $projet['description'];
        echo ' </div>';

        echo ' <div class="contact-projet">';
        echo '      <h3> Coordonnées contact </h3>';

        echo ' </div>';
        echo ' <div class="contact-projet">';
        echo '      <h3> Ressources du projet </h3>';
        echo '      <p>URL d’accès aux fichiers de description et des données du data challenge: </p>';
        echo '      <a href ='.$projet['urlFichier'].'>Description du projet</a>';
        echo '      <p>URL vidéo de présentation du projet.</p>';
        echo '      <a href ='.$projet['urlVideo'].'>Vidéo du projet</a>';
        echo ' </div>';
        echo '          <img src="'.$projet['imageEvent'].'" alt="'.$projet['nomEvenement'].'">';
        echo '      </div>';
        echo '      </div>';
    }
    echo '</div>';


            
?>