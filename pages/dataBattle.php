<?php


if(isset($_GET['battle'])){
        $nomBattle = $_GET['battle'];
    }

    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }



    echo '<h1>'. $nomBattle . '</h3>';
    echo '<p>'. $nomChallenge . '</p>';

    $projet = getProjetData($nomBattle);

    echo '<div class=projet>';

        echo ' <div class = "title">';
        echo '      <h2>'. $projet[0]['nomProjet'] . '</h2>';
        echo ' </div>';
        echo ' <div class = "description">';
        echo        $projet[0]['description'];
        echo ' </div>';

        $gestionnaire = getSuperviseur($projet[0]['nomProjet']);
        echo ' <div class="contact-projet">';
        echo '      <h3> Coordonnées contact </h3>';
        echo '      <div class = "contact-gestionnaire">';
        echo '          <p>'.$gestionnaire[0]['prenomUtilisateur'].' ' . $gestionnaire[0]['nomUtilisateur'].'</p>';
        echo '          <p> Mail : ' .$gestionnaire[0]['email'] .' Tel :'. $gestionnaire[0]['numeroTel'] .'</p>';
        echo '      </div>';
        echo ' </div>';
        echo ' <div class="ressources-projet">';
        echo '      <h3> Ressources du projet </h3>';
        echo '      <p>URL d\'accès aux fichiers de description et des données du data challenge: </p>';
        echo '      <a href ='.$projet['urlFichier'].'>Description du projet</a>';
        echo '      <p>URL vidéo de présentation du projet.</p>';
        echo '      <a href ='.$projet['urlVideo'].'>Vidéo du projet</a>';
        echo ' </div>';
        echo '          <img src="'.$projet['imageEvent'].'" alt="'.$projet['nomEvenement'].'">';
        echo '      </div>';
        echo '      </div>';
    echo '</div>';


            
?>