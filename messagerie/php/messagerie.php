<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/messagerie.css" />
    <title>messagerie</title>
    <script type="text/javascript" src="../js/messagerie.js"></script>
  
</head>
<body>
        <?php
            $serveur = "localhost";
            $user = "quentin";
            $pass = "*noeDu64*";
            $cnx = mysqli_connect($serveur, $user, $pass);
            if (mysqli_connect_errno($cnx)) {
                echo "Erreur de connexion a MySQL: " . mysqli_connect_error();
                exit();
            }
            $dbname = "projetIaPau";

            
        ?>
    
        
        <!--TODO rajouter signalement-->
        <div id="messagerie-container">
            <div id="name">

            </div> 
            <div id="les-discussions">

                <select id="select-discussion" size="5">
                    
                    <?php
                        
                
                        
                        mysqli_select_db($cnx, $dbname);
                        $query = "SELECT idUtilisateur,nomUtilisateur,prenomUtilisateur FROM Utilisateur";
                        $result = mysqli_query($cnx,$query);
                        if ($result) {
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<option onclick=newDestinataire("'.$row['idUtilisateur'].'") value="'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'">'.$row['prenomUtilisateur'].' '. $row['nomUtilisateur'].'</option>' ;
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
                <div class="message envoye">
                    <div class="premiere-ligne">
                        <p class="auteur">Jean Michel</p>
                        <div class="plus">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <p class="infos">18/04/2022 23:17:03</p>

                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde veniam aspernatur ducimus, dolor, temporibus magni explicabo voluptatem non totam itaque atque aut quos? Numquam, Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet inventore repellendus exercitationem corrupti excepturi! Veniam hic omnis, vel unde quos blanditiis atque perferendis! Nemo veritatis magnam laudantium incidunt. Autem, neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim temporibus inventore sit adipisci ducimus deleniti quos nam repellendus asperiores. Eos alias, deserunt aperiam cum quisquam dolores iusto hic iste numquam? fugiat nesciunt deleniti doloremque reiciendis delectus. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam libero numquam vel illum dignissimos. Consectetur maiores repellendus quas placeat velit nemo atque ipsa earum! Modi quaerat itaque nisi quos consequatur. !</p>
                </div>
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
</html>
