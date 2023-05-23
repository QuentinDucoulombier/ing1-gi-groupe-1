
<link rel="stylesheet" href="styles/component/evenements.css" />

<div id="liste-evenement">
    <?php
        $challenges = getChallenge();
        $battles = getBattle();
    ?>

    
    <div>
        <p>Liste des Data Challenge</p>
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
                echo '          <div class="event-date"> Du '.$challenge['dateDebut'] .' Au '. $challenge['dateFin'].'</div>';
                echo '          <div class="event-description">'.$challenge['descriptionEvent'].'</div>';
                echo '      </div>';
                echo '      <div class="button">';
                echo '          <a href="/?page=dataChallenge&challenge='.$challenge['nomEvenement'].'"> <button name="voirplus"> Voir Plus </button> </a>';
                //if (isset($_SESSION['email'])){
                //    echo `      <a href=""> <button name="sinscrire"> S'inscrire </button> </a>`;
                //}
                echo '      </div>';
                echo ' </div>';
            }
        ?>
    </div>

    <div>
        <p>Liste des Data Battle</p>
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
                echo '      <div class="button">';
                echo '          <a href=""> <button name="voirplus"> Voir Plus </button> </a>';
                //if (isset($_SESSION['email'])){
                //    echo `      <a href=""> <button name="sinscrire"> S'inscrire </button> </a>`;
                //}
                echo '      </div>';
                echo ' </div>';
            }
        ?>

    </div>


</div>