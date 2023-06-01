<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/component/messagerie.css" />
    <title>messagerie</title>
    <script type="text/javascript" src="../scripts/messagerie.js"></script>
  
</head>
<body>
        <?php

            session_start();
            $cnx = conn2();
            $dbname = "projetIaPau";
            //echo $_SESSION["idUser"];
            $idUser = $_SESSION["idUser"];
            mysqli_select_db($cnx, $dbname);
            $queryDestinataire = "UPDATE Auteur SET idUtilisateur = '$idUser'";
            if(mysqli_query($cnx, $queryDestinataire)) {
                //echo "Les valeurs de l'auteur ont été modifiées avec succès";

            } else {
                echo "Erreur lors de la modification des valeurs de l'auteur : " . mysqli_error($cnx);
            }

        ?>
    
        
        <div id="messagerie-container">
            <div id="name">

            </div> 
            <div id="les-discussions">

                <select id="select-discussion" size="5">
                    
                    <?php
                        
                        $query = "SELECT idUtilisateur,nomUtilisateur,prenomUtilisateur FROM Utilisateur";
                        $result = mysqli_query($cnx,$query);
                        if ($result) {
                            while($row = mysqli_fetch_assoc($result)){
                                $isLu = getLu($idUser,$row['idUtilisateur']);
                                if(empty($isLu))  {
                                    echo '<option onclick=newDestinataire("'.$row['idUtilisateur'].'") value="'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'">'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'</option>' ;
                                }
                                else {
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
                
            </div>
            <div id="bas-messagerie">
                <div id="nouv-message">
                    <input id="message-text" type="text" value="">
                    <button onclick="newMsg()">Envoyer</button>
                </div>
                
            </div>

            

        </div>
        <div id="test">
            
        </div>

</body>
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

    <script type="text/javascript" src="../scripts/messagerieInput.js"></script>


</html>
