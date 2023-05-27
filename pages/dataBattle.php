<link rel="stylesheet" href="styles/component/evenements.css" />

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
    $projet = getProjetData($battle['nomEvenement']);

    echo '<h1>'. $battle['nomEvenement'] . '</h3>';
    echo '<p>'. $battle['dateD'].' - '.$battle['dateF'].'</p>';

    if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
        echo '          <a href="/?page=modifierBattle"> ';
        echo '              <button name="creation"> Modifier la battle </button> ';
        echo '          </a>';
    }

    // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
    if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $challenge['nomEvenement']) ) ) ) {
        echo '          <a href="/?page=synthèseChallenge&projet='.$battle['idEvenement'].'"> ';
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

    if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
        echo '          <a href="/?page=modifierBattle"> ';
        echo '              <button name="creation"> Modifier le projet </button> ';
        echo '          </a>';
    }
    // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
    if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $challenge['nomEvenement']) ) ) ) {
        echo '          <a href="/?page=synthèseProjet&projet='.$projet[0]['idProjetData'].'"> ';
        echo '              <button name="gestion"> Synthèse du projet </button> ';
        echo '          </a>';
    }

    echo '      </div>';

    echo '      <div class=image-projet>';
    echo '          <img src="'.$projet[0]['imageEvent'].'" alt="'.$projet[0]['nomEvenement'].'">';
    echo '      </div>';


    $gestionnaires = getSuperviseur($projet[0]['nomProjet']);

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
    echo '          <a href ='.$projet[0]['urlFichier'].'>Description du projet</a>';
    echo '          <p>URL vidéo de présentation du projet.</p>';
    echo '          <a href ='.$projet[0]['urlVideo'].'>Vidéo de présentation du projet</a>';
    echo '      </div>';

    echo '  </div>';


            
?>