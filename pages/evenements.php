
<link rel="stylesheet" href="styles/component/evenements.css" />

<div id="liste-evenement">
    <?php
        $challenges = getChallenge();
        $battles = getBattle();
        $user = getUser($_SESSION['email']);
    ?>

    
    <div class=title>
        <h1>Liste des Data Challenge</h1>
    </div>
    <div id=liste-challenge>
        <?php

            foreach ($challenges as $challenge){
                echo ' <div class = "card">';
                echo '      <div class="event-image">';
                echo '          <a class ="more-link" href="/?page=dataBattle&battle='.$challenge['nomEvenement'].'">';
                echo '              <img src="'.$challenge['imageEvent'].'" alt="'.$challenge['nomEvenement'].'">';
                echo '          </a>';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$challenge['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$challenge['dateD'] .' Au '. $challenge['dateF'].'</div>';
                echo '          <div class="event-description">'.$challenge['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataChallenge&challenge='.$challenge['nomEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';
                if ($user[0]['type'] == "Etudiant") {
                    echo '      <a href="/?page=inscriptionChallenge&challenge='.$challenge['nomEvenement'].'&type=dataChallenge"> <button name="sinscrire"> S\'inscrire </button> </a>';
                }
                //if ($user[0]['type'] == "Etudiant") {
                //    echo '      <a href=""> <button name="monProjet"> Mon projet </button> </a>';
                //}
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
                echo '          <a class ="more-link" href="/?page=dataBattle&battle='.$battle['nomEvenement'].'">';
                echo '              <img src="'.$battle['imageEvent'].'" alt="'.$battle['nomEvenement'].'">';
                echo '          </a>';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$battle['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$battle['dateD'] .' Au '. $battle['dateF'].'</div>';
                echo '          <div class="event-description">'.$battle['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataBattle&battle='.$battle['nomEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';
                if ($user[0]['type'] == "Etudiant") {
                    echo '      <a href="/?page=inscriptionChallenge&challenge='.$battle['nomEvenement'].'&type=dataBattle"> <button name="sinscrire"> S\'inscrire </button> </a>';
                }
                //if ($user[0]['type'] == "Etudiant") {
                //    echo '      <a href=""> <button name="monProjet"> Mon projet </button> </a>';
                //}
                echo '      </div>';
                echo ' </div>';
            }
        ?>

    </div>


</div>