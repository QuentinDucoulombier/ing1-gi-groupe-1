<!-- Inclusion des fichiers CSS et JavaScript -->
<link rel="stylesheet" href="../styles/component/messagerie.css" />
<script type="text/javascript" src="../scripts/messagerie.js"></script>  

<!-- Début de la division principale "messagerie" -->
<div id="messagerie">

    <?php
        // Début du code PHP
        session_start();

        $cnx = conn2();
        $dbname = "projetIaPau";
        $idUser = $_SESSION["idUser"];

        // Sélection de la base de données
        mysqli_select_db($cnx, $dbname);

        // Mise à jour de la table "Auteur" avec l'ID de l'utilisateur actuel
        $queryDestinataire = "UPDATE Auteur SET idUtilisateur = '$idUser'";
        if(mysqli_query($cnx, $queryDestinataire)) {
            // Les valeurs de l'auteur ont été modifiées avec succès
        } else {
            echo "Erreur lors de la modification des valeurs de l'auteur : " . mysqli_error($cnx);
        }
    ?>
    
    <!-- Début de la division "messagerie-container" -->
    <div id="messagerie-container">
        <div id="name">
        </div> 

        <div id="les-discussions">
            <select id="select-discussion" size="5">
                <?php
                    // Requête SQL pour récupérer les utilisateurs de la table "Utilisateur"
                    $query = "SELECT idUtilisateur,nomUtilisateur,prenomUtilisateur FROM Utilisateur";
                    $result = mysqli_query($cnx,$query);
                    if ($result) {
                        while($row = mysqli_fetch_assoc($result)){
                            $isLu = getLu($idUser,$row['idUtilisateur']);

                            if(empty($isLu)) {
                                // Option pour un utilisateur non lu
                                echo '<option onclick=newDestinataire("'.$row['idUtilisateur'].'") value="'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'">'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'</option>' ;
                            } else {
                                // Option pour un utilisateur lu avec une classe "notification"
                                echo '<option class="notification" onclick=newDestinataire("'.$row['idUtilisateur'].'") value="'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'">'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'</option>' ;
                            }
                        }
                    } else {
                        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($cnx);
                    }
                    mysqli_close($cnx);
                ?>
            </select>
        </div>

        <div id="la-discussion">
            <div id="message-zone">
                <!-- Contenu de la zone des messages -->
            </div>
            <div id="bas-messagerie">
                <div id="nouv-message">
                    <input id="message-text" type="text" value="">
                    <button onclick="newMsg()">Envoyer</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Inclusion des fichiers JavaScript -->
<script type="text/javascript" src="../scripts/messagerieInput.js"></script>

<!--
    <script>

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function verification_message() {
            recup_messages();
            //console.log(id_dernier_message);
            await sleep(5000);
            verification_message();
        }
        verification_message();
    </script>
-->