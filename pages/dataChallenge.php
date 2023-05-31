<link rel="stylesheet" href="styles/component/evenements.css" />
<div class="data-event">
<?php


    if(isset($_GET['challenge'])){
        $id = $_GET['challenge'];
    }

    /*Rediriger vers la page 404 à la place de ceci?*/ 
    else {
        echo "Bad request ";
        exit();
    }

    if (isset($_SESSION['email'])){
        $user = getUser($_SESSION['email']);
    }

    $challenge = getEvenementbyID($id);

    $projets = getProjetData($id);

    echo '<h1 class="data-name">'. $challenge['nomEvenement'] . '</h3>';
    echo '<p class="date">'. $challenge['dateD'].' - '.$challenge['dateF'].'</p>';

    if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
        echo '          <a href="/?page=modifierChallenge"> ';
        echo '              <button name="creation"> Modifier le challenge </button> ';
        echo '          </a>';
    }

    // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
    if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur")  ) ) {
        echo '          <a href="/?page=syntheseChallenge&challenge='.$challenge['idEvenement'].'"> ';
        echo '              <button name="gestion"> Synthèse du challenge </button> ';
        echo '          </a>';
    }


    echo '<div class=liste-projet>';

    foreach ($projets as $projet){
        echo '  <div class=projet>';

        echo '      <div class = "en-tete">';

        echo '          <div class = "desc">';
        echo '              <div class = "title-projet">';
        echo '                  <h2>'. $projet['nomProjet'] . '</h2>';
        echo '              </div>';

        echo '              <div class = "description">';
        echo                    $projet['description'];
        echo '              </div>';
        echo '          </div>';
        // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
        if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjetData($user[0]['email'], $projet['idProjetData']) ) ) ) {
            echo '          <a href="/?page=syntheseProjet&projet='.$projet['idProjetData'].'"> ';
            echo '              <button name="gestion"> Synthèse du projet </button> ';
            echo '          </a>';
        }// Si l'utilisateur est un étudiant inscrit au challenge on lui propose de d'accéder au récap du projet pour lequel il est inscrit
        if (isset($_SESSION['email']) && $user[0]['type'] == "Etudiant" && checkInscriptionProjet($user[0]['email'], $projet['idProjetData'])) {
            echo '          <a href="/?page=descriptionData&idChallenge='.$projet['idProjetData'].'"> ';
            echo '              <button name="monProjet"> Mon projet </button> ';
            echo '          </a>';
        }

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
</div>