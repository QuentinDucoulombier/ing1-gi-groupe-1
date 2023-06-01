<link rel="stylesheet" href="styles/component/manageTeam.css" />
<div id=manageTeam>
    <?php
        session_start();
        /*verif connexion et statut*/

        if (!isset($_SESSION['email'])) {
            header ('Location: /?page=404');
        } else {
            $user = getUser($_SESSION['email']);
            if ($user[0]['type'] != "Etudiant" && isset($_SESSION["idTeam"])) 
            {
                header ('Location: /?page=404');
            }
        }
        $idEquipe = $_SESSION["idTeam"];

        $idProjet = $_SESSION["idProjet"];
        $idUser = $_SESSION["idUser"];
        $infoTeam = getInfoViewTeam($idUser,$idProjet);
        $members = getAllMemberTeam($idEquipe);
        $capitaine = getUserById($infoTeam["idCapitaine"]);
        echo '
            <p><strong>Equipe:</strong> '.$infoTeam["nomEquipe"].'</p>
            <p><strong>Projet: </strong>'.$infoTeam["nomProjet"].'</p>
            <p><strong>Capitaine: </strong> '.$capitaine["prenomUtilisateur"].' '.$capitaine["nomUtilisateur"].'</p>
            <br>
            <p><strong>Membres:</strong> </p>
        ';

        echo '<div id="table">';
            echo '<table>';
                foreach($members as $i=>$member) { 
                    $i++;
                    echo '
                        <tr>
                            <td>Membre '.$i.': '.$member["prenomUtilisateur"].' '.$member["nomUtilisateur"].'</td>
                            <td><button class="sendMsg" onclick="window.location.href=`./?page=messagerie`">Envoyer un message</button></td>
                        </tr>
                    ';
                }
            echo '</table>';
        echo '</div>';
    
    
    ?>
    
    

    <div id="result">
        
    </div>
    <?php
        echo '<br><a href="./?page=descriptionData&idChallenge='.$idProjet.'">Retour description data</a>';
    ?>
</div>