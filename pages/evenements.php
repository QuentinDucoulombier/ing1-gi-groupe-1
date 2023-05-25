
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
                echo '          <img src="'.$challenge['imageEvent'].'" alt="'.$challenge['nomEvenement'].'">';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$challenge['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$challenge['dateD'] .' Au '. $challenge['dateF'].'</div>';
                echo '          <div class="event-description">'.$challenge['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataChallenge&challenge='.$challenge['nomEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';
                if ($user[0]['type'] == "Etudiant") {
                    echo '      <a href=""> <button name="sinscrire"> S\'inscrire </button> </a>';
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
                echo '          <img src="'.$battle['imageEvent'].'" alt="'.$battle['nomEvenement'].'">';
                echo '      </div>';
                echo '      <div class = "event-details">';
                echo '          <div class="event-name">'.$battle['nomEvenement'].'</div>';
                echo '          <div class="event-date"> Du '.$battle['dateDebut'] .' Au '. $battle['dateFin'].'</div>';
                echo '          <div class="event-description">'.$battle['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '          <a class ="more-link" href="/?page=dataChallenge&challenge='.$challenge['nomEvenement'].'"> Lire Plus </a>';
                echo '      <div class="button-projet">';
                if ($user[0]['type'] == "Etudiant") {
                    echo '      <a href=""> <button name="sinscrire"> S\'inscrire </button> </a>';
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