
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
                if (!isset($_SESSION['email'])){
                    echo '          <a href="/?page=connexion">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a>';
                }
                if ($user[0]['type'] == "Etudiant" && !checkInscription($user[0]['email'], $challenge['nomEvenement'])) {
                    echo '          <a href="/?page=inscriptionChallenge&evenement='.$challenge['idEvenement'].'">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a> ';
                }
                if ($user[0]['type'] == "Etudiant" && checkInscription($user[0]['email'], $challenge['nomEvenement'])) {
                    echo '          <a href="/?page=monProjet&projet='.$challenge['idEvenement'].'"> ';
                    echo '              <button name="monProjet"> Mon projet </button> ';
                    echo '          </a>';
                }
                if ($user[0]['type'] == "Administrateur") {
                    echo '          <a href="/?page=gererChallenge&projet='.$challenge['idEvenement'].'"> ';
                    echo '              <button name="gestion"> Gérer le challenge </button> ';
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
                if (!isset($_SESSION['email'])){
                    echo '          <a href="/?page=connexion">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a>';
                }
                if ($user[0]['type'] == "Etudiant" && !checkInscription($user[0]['email'], $battle['nomEvenement'])) {
                    echo '          <a href="/?page=inscriptionChallenge&evenement='.$battle['idEvenement'].'">';
                    echo '              <button name="sinscrire"> S\'inscrire </button>';
                    echo '          </a> ';
                }
                if ($user[0]['type'] == "Etudiant" && checkInscription($user[0]['email'], $battle['nomEvenement'])) {
                    echo '          <a href="/?page=monProjet&projet='.$battle['idEvenement'].'"> ';
                    echo '              <button name="monProjet"> Mon projet </button> ';
                                        
                    echo '          </a>';
                }
                if ($user[0]['type'] == "Administrateur") {
                    echo '          <a href="/?page=gererChallenge&projet='.$battle['idEvenement'].'"> ';
                    echo '              <button name="gestion"> Gérer la battle </button> ';
                    echo '          </a>';
                }
                echo '      </div>';
                echo ' </div>';
            }
        ?>

    </div>


</div>