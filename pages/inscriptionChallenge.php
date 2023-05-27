<link rel="stylesheet" href="../styles/component/inscription.css" />

<div id="insChallenge">
<?php
    $datas = getData($_GET["challenge"]);
    echo '<div id=descriptionProjet>';
   foreach ($datas as $i=>$data) {
        if($i == 0)
        {
            echo '<h1>Inscription au '.$data["nomEvenement"].'</h1>
            <p id=date>Du '.$data["dateDebut"].' au  '.$data["dateFin"].'</p>
            ';

        }

        echo '

            <h2>Description du '.$data["nomProjet"].'</h2>


            <p id=description>
                '.$data["descriptionEvent"].'
            </p>

            ';
            
        
    }
    echo '</div>';
    echo '<div id=choixProjet>';
    echo 'Valider votre projet';
    echo '<form action="./?page=descriptionData" method="POST">';

        
    foreach($datas as $i=>$data) {
        if($data["typeEvenement"] == "dataChallenge") {
            echo '<input type="radio" id="choixChallenge'.$i.'" name="choixChallenge" value="'.$data["idProjetData"].'" required/>
                  <label for="choixChallenge'.$i.'">'.$data["nomProjet"].'</label>
            ';
                

        }
        else {
            echo '<input type="hidden" name="choixChallenge" value="'.$data["idProjetData"].'"/>';
        }
    }
    echo '
            <input type="submit" id="subChallenge" value="Valider mon inscription"/>
        </form>
    </div>';

?>
</div>