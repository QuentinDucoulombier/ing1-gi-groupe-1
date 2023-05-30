<link rel="stylesheet" href="styles/component/manageTeam.css" />
<div id=manageTeam>
    <?php
        session_start();
        $idEquipe = $_SESSION["idTeam"];

        $idProjet = $_SESSION["idProjet"];
        $user = getUser($_SESSION["email"]);
        $idUser = $user[0]['idUtilisateur'];
        $infoTeam = getInfoManageTeam($idUser,$idProjet);
        $members = getAllMemberTeam($idEquipe);
        echo '
            <p><strong>Equipe:</strong> '.$infoTeam["nomEquipe"].'</p>
            <p><strong>Projet: </strong>'.$infoTeam["nomProjet"].'</p>
            <p><strong>Capitaine: </strong> '.$infoTeam["prenomUtilisateur"].' '.$infoTeam["nomUtilisateur"].'</p>
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
        echo '<a href="./?page=descriptionData&idChallenge='.$idProjet.'">Retour description data</a>';
    ?>
</div>