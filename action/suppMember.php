<?php
    require('bdd.php');
    suppUserTeam($_POST["idUser"], $_POST["idTeam"]);
    $res = verifSuppUser($_POST["idUser"], $_POST["idTeam"]);

    $members = getAllMemberTeam($_POST["idTeam"]);
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
    if(empty($res)) {
        echo '<p style="color: green;">Membre supprimé avec succès !</p>';
    }
    else {
        echo '<p style="color: red;">Erreur dans la suppression du membre !</p>'; 
    }

?>