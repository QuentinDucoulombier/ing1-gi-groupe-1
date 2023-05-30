<?php
    require('bdd.php');
    session_start();
    addUserTeam($_POST["idUser"], $_SESSION["idTeam"]);
    $members = getAllMemberTeam($_SESSION["idTeam"]);
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
    /*TODO:Rajouter verification ?*/
    echo '<p style="color: green;">Membre ajouté avec succès !</p>';

?>