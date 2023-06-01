<link rel="stylesheet" href="styles/component/viewMessageTeam.css" />

<div id="viewMessageTeam">
    <?php
    

        if (isset($_SESSION['email']))
        {
            $user = getUser($_SESSION['email']);

            if ($user[0]['type'] == "Administrateur" || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $battle['nomEvenement']) )) {

                $idTeam = $_POST["idTeam"];
                $results = getMessageTeam($idTeam);
                if(!(empty($results))) {

                    echo '<h1>Historique des messages</h1>';
                    echo '<table>';
                    echo '<tr><th>Message</th><th>Date d\'envoi</th><th>Destinataire</th><th>Auteur</th></tr>';

                    foreach($results as $result) {
                        echo '<tr>';
                            echo '<td>' . $result['message'] . '</td>';
                            echo '<td>' . $result['date_envoi'] . '</td>';
                            echo '<td>' . $result['nomDestinataire'] . ' ' . $result['prenomDestinataire'] . '</td>';
                            echo '<td>' . $result['nomAuteur'] . ' ' . $result['prenomAuteur'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                }
                else {
                    echo '<h1>Aucun messages n\'a était envoyé !</h1>';
                }
            }
            else {
                header ('Location: /?page=404');
            }
            
        }
        else {
            header ('Location: /?page=404');
        }
    ?>
</div>
