<!--TODO:
    - Verifier que le nombre de membre est compris entre 3 et 8
    - Supprimer en ajax

-->
<div id=manageTeam>
    <?php
        session_start();
        $idEquipe = $_SESSION["idTeam"];
        
        $members = getAllMemberTeam($idEquipe);
        echo '
            <p>Equipe: </p>
            <p>Projet: </p>
            <p>Capitaine: </p>
            <p>Membres: </p>
        ';


        echo '<table>';
            foreach($members as $i=>$member) { 
                $i++;
                echo '
                    <tr>
                        <td>Membre '.$i.': '.$member["prenomUtilisateur"].' '.$member["nomUtilisateur"].'</td>
                        <td><button onclick="window.location.href=`./?page=messagerie`">Envoyer un message</button></td>
                        <td><button onclick="">Supprimer</button></td>
                    </tr>
                ';
            }
        echo '</table>';
        
    ?>
    <div id="supp">

    </div>
    <!--Voir comment faire pour ajouter-->
    <button>Ajouter membre</button>
    <!--Faire en ajax-->
    <button>Supprimer équipe</button>

</div>
