
<link rel="stylesheet" href="styles/component/evenements.css" />

<div id="liste-evenement">
    <?php
        $challenges = getChallenge();
        $battles = getBattle();
        if (isset($_SESSION['email'])){
            $user = getUser($_SESSION['email']);
        }
    ?>

    
    <div class=title>
        <h1>Liste des Data Challenge</h1>
    </div>

    <?php
        // Si l'utilisateur est administrateur il peut créer un nouveau challenge
        if (isset($_SESSION['email']) && $user[0]['type'] == "Administrateur") {
            echo '          <a href="/?page=creerChallenge"> ';
            echo '              <button name="creation"> Créer un évenement </button> ';
            echo '          </a>';
        }

    ?>
    <div id=liste-challenge>

        <?php

            foreach ($challenges as $challenge){
                echo ' <div class = "card">';
                echo '      <div class="event-image">';
                echo '          <a class ="more-link" href="/?page=dataChallenge&challenge='.$challenge['idEvenement'].'">';
                echo '              <img src="'.$challenge['imageEvent'].'" alt="'.$challenge['nomEvenement'].'">';
                echo '          </a>';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$challenge['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$challenge['dateD'] .' Au '. $challenge['dateF'].'</div>';
                echo '          <div class="event-description">'.$challenge['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataChallenge&challenge='.$challenge['idEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';

                // Si l'utilisateur n'est pas connecté on le renvoie sur la page de connexion afin qu'il puisse s'inscrire au challenge
                if (!isset($_SESSION['email'])){
                    
                    echo '          <a href="/?page=connexion">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a>';
                }

                // Si l'utilisateur est un étudiant qui n'est pas inscrit au challenge on lui propose de s'inscrire
                if (isset($_SESSION['email']) && $user[0]['type'] == "Etudiant" && !checkInscriptionProjet($user[0]['email'], $challenge['nomEvenement'])) {
                    echo '          <a href="/?page=inscriptionChallenge&evenement='.$challenge['idEvenement'].'">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a> ';
                }

                // Si l'utilisateur est un étudiant inscrit au challenge on lui propose de d'accéder au récap du projet pour lequel il est inscrit
                if (isset($_SESSION['email']) && $user[0]['type'] == "Etudiant" && checkInscriptionProjet($user[0]['email'], $challenge['nomEvenement'])) {
                    echo '          <a href="/?page=descriptionChallenge&projet='.$challenge['idEvenement'].'"> ';
                    echo '              <button name="monProjet"> Mon projet </button> ';
                    echo '          </a>';
                }

                // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché au challenge il peut accéder à la synthèse du challenge
                if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $challenge['nomEvenement']) ) ) ) {
                    echo '          <a href="/?page=synthèseChallenge&projet='.$challenge['idEvenement'].'"> ';
                    echo '              <button name="gestion"> Synthèse du challenge </button> ';
                    echo '          </a>';
                }

                echo '      </div>';
                echo ' </div>';
            }
        ?>
    </div>

    <div class="title">
        <h1>Liste des Data Battle</h1>
    </div>

    <div id=liste-battle>

        <?php
            foreach ($battles as $battle){
                echo ' <div class = "card">';
                echo '      <div class="event-image">';
                echo '          <a class ="more-link" href="/?page=dataBattle&battle='.$battle['idEvenement'].'">';
                echo '              <img src="'.$battle['imageEvent'].'" alt="'.$battle['nomEvenement'].'">';
                echo '          </a>';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$battle['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$battle['dateD'] .' Au '. $battle['dateF'].'</div>';
                echo '          <div class="event-description">'.$battle['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataBattle&battle='.$battle['idEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';

                // Si l'utilisateur n'est pas connecté on le renvoie sur la page de connexion afin qu'il puisse s'inscrire au challenge
                if (!isset($_SESSION['email'])){
                    echo '          <a href="/?page=connexion">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a>';
                }

                // Si l'utilisateur est un étudiant qui n'est pas inscrit à la battle on lui propose de s'inscrire
                if ($user[0]['type'] == "Etudiant" && !checkInscriptionProjet($user[0]['email'], $battle['nomEvenement'])) {
                    echo '          <a href="/?page=inscriptionChallenge&evenement='.$battle['idEvenement'].'">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a> ';
                }

                // Si l'utilisateur est un étudiant inscrit à la battle on lui propose de d'accéder au récap du projet pour lequel il est inscrit
                if ($user[0]['type'] == "Etudiant" && checkInscriptionProjet($user[0]['email'], $battle['nomEvenement'])) {
                    echo '          <a href="/?page=monProjet&projet='.$battle['idEvenement'].'"> ';
                    echo '              <button name="monProjet"> Mon projet </button> ';                                        
                    echo '          </a>';
                }

                // Si l'utilisateur est un administrateur ou s'il est un gestionnaire rattaché à la battle il peut accéder à la synthèse du challenge
                if (isset($_SESSION['email']) && ( ($user[0]['type'] == "Administrateur") || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $challenge['nomEvenement']) ) ) ) {
                    echo '          <a href="/?page=synthèseChallenge&projet='.$challenge['idEvenement'].'"> ';
                    echo '              <button name="gestion"> Synthèse du challenge </button> ';
                    echo '          </a>';
                }
                echo '      </div>';
                echo ' </div>';
            }
        ?>

    </div>


</div>