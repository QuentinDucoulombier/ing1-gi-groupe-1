<?php
    require('bdd.php');

    if (isset($_POST['query'])) {
        $query = $_POST['query'];


        $results = searchStudent($query);

        // Afficher les membres suggérés sous forme de liens cliquables
        foreach ($results as $member) {
            echo '<button class="Bsuggestion" onclick="addMember('.$member['idUtilisateur'].','.$member['idEquipe'].')">' . $member['prenomUtilisateur'] . ' ' . $member['nomUtilisateur'] . '</button><br>';
        }
    }
?>