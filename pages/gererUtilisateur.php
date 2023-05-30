<?php
if (isset($_SESSION['email'])) {
    //recuperer les infos de tous les utilisateurs
    $infos = getAllUsers();
    //afficher les infos de tous les utilisateurs dans un tableau
    ?>

    <div>
        <h1>Gérer les utilisateurs</h1>
    </div>

    <div class="tableau">
        <h2>Étudiants</h2>
        <table id="tableauEtudiants">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Numéro de téléphone</th>
                <th>Niveau d'étude</th>
                <th>Ecole</th>
                <th>Ville</th>
                <th>Mot de passe</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $etudiants = array_filter($infos, function ($info) {
                return $info['type'] === 'Etudiant';
            });

            foreach ($etudiants as $info) {
                echo "<tr>";
                echo "<td>" . $info['prenomUtilisateur'] . "</td>";
                echo "<td>" . $info['nomUtilisateur'] . "</td>";
                echo "<td>" . $info['email'] . "</td>";
                echo "<td>" . $info['type'] . "</td>";
                echo "<td>" . $info['numeroTel'] . "</td>";
                echo "<td>" . $info['niveauEtude'] . "</td>";
                echo "<td>" . $info['ecole'] . "</td>";
                echo "<td>" . $info['ville'] . "</td>";
                echo "<td>" . $info['motDePasse'] . "</td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='toggleEditEtudiant(this)'>Modifier</button></td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='supprimerUtilisateur(this)'>Supprimer</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="11"><button id="ajouter-btn1" onclick="ajouterEtudiant()">Ajouter un étudiant</button></td>
            </tr>
        </table>

        <h2>Gestionnaires</h2>
        <table id="tableauGestionnaire">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Numéro de téléphone</th>
                <th>Nom de l'entreprise</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Mot de passe</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $gestionnaires = array_filter($infos, function ($info) {
                return $info['type'] === 'Gestionnaire';
            });

            foreach ($gestionnaires as $info) {
                echo "<tr>";
                echo "<td>" . $info['prenomUtilisateur'] . "</td>";
                echo "<td>" . $info['nomUtilisateur'] . "</td>";
                echo "<td>" . $info['email'] . "</td>";
                echo "<td>" . $info['type'] . "</td>";
                echo "<td>" . $info['numeroTel'] . "</td>";
                echo "<td>" . $info['nomEntreprise'] . "</td>";
                // if (isset($info['dateDebutUtilisateur'])) {
                //     echo "<td>" . date('d F Y', strtotime($info['dateDebutUtilisateur'])) . "</td>";
                // } else {
                //     echo "<td></td>";
                // }
                echo "<td>" . $info['dateDebutUtilisateur'] . "</td>";
                // if (isset($info['dateFinUtilisateur'])) {
                //     echo "<td>" . date('d F Y', strtotime($info['dateFinUtilisateur'])) . "</td>";
                // } else {
                //     echo "<td></td>";
                // }
                echo "<td>" . $info['dateFinUtilisateur'] . "</td>";
                echo "<td>" . $info['motDePasse'] . "</td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='toggleEditGestionnaire(this)'>Modifier</button></td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='supprimerUtilisateur(this)'>Supprimer</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="11"><button id="ajouter-btn2" onclick="ajouterGestionnaire()">Ajouter un gestionnaire</button></td>
            </tr>
        </table>
    </div>



    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}
?>