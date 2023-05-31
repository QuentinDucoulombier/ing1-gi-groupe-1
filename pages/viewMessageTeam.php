<div id="viewMessageTeam">
    <?php
        $idTeam = $_POST["idTeam"];
        $results = getMessageTeam($idTeam);

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
    ?>
</div>
