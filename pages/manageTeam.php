<link rel="stylesheet" href="styles/component/manageTeam.css" />
<script type="text/javascript" src="../scripts/manageTeam.js"></script>
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
                            <td><button class="suppMember" onclick="supprimerMember('.$member["idUtilisateur"].','.$member["idEquipe"].')">Supprimer</button></td>
                        </tr>
                    ';
                }
            echo '</table>';
            if($i<3) {
                echo '<p id="red"><strong>Il est conseillez de constituer une equipe de minimum 3 personnes</strong></p>';
            }
        echo '</div>';
    
    
    
    echo '<button class="addMember" onclick="searchMember('.$i.')">Ajouter membre</button>';
    ?>
    <button class="suppTeam" onclick="suppTeam()">Supprimer équipe</button>
    
    

    <div id="result">
        
    </div>
    <?php
        echo '<a href="./?page=descriptionData&idChallenge='.$idProjet.'">Retour description data</a>';
    ?>
</div>
