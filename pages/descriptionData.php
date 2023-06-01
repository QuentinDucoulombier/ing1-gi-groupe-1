<link rel="stylesheet" href="styles/component/descriptionData.css" />

<div>

<?php
    /*verif connexion et statut*/
    session_start();
    if (!isset($_SESSION['email'])) {
        header ('Location: /?page=404');
    } else {
        $user = getUser($_SESSION['email']);
        if ($user[0]['type'] != "Etudiant") 
        {
            header ('Location: /?page=404');
        }
    }
    if(isset($_POST["choixChallenge"]))
    {
        $choixChallenge = $_POST["choixChallenge"];
    }
    elseif(isset($_GET["idChallenge"])) {
        $choixChallenge = $_GET["idChallenge"];
    }
    else {
        header('Location: /?page=index');
    }
    $data = getDataProjet($choixChallenge);
    $superviseurs = getSuperviseurUtilisateur($choixChallenge);
    $user = getUser($_SESSION['email']);

    $idUser = $user[0]['idUtilisateur'];
    $_SESSION["idUser"] = $idUser;
    $response = verifEquipe($idUser,$choixChallenge);
    if(!(empty($response))){
        $_SESSION['idTeam'] = $response["idEquipe"];
    }

    $youtubeLink = $data["urlVideo"];

    // Extraction de l'identifiant de la vidéo
    $videoId = '';
    parse_str(parse_url($youtubeLink, PHP_URL_QUERY), $params);
    if (isset($params['v'])) {
        $videoId = $params['v'];
    }

    // Construction du lien embarqué
    $embedLink = 'https://www.youtube.com/embed/' . $videoId;

    echo '


    <h1 class="data-name">'.$data["nomEvenement"].'</h1>

        
    <p class="date">Data challenge du '.$data["dateDebut"].'</p>
        <div id="boutton">
            <button onclick="window.location.href=`./?page=messagerie`">Envoyer un message</button>
            <button onclick="window.location.href=`../action/verifEquipe.php?projet='.$choixChallenge.'`">Créer/gérer mon équipe</button>
        </div>
            <div id="description">
            <h2>'.$data["nomProjet"].': </h2>

            <div id="descriptionProjet"/>
                '.$data["description"].'
            </div>
            <img src="../'.$data["imageEvent"].'" alt="image du projet"></img>
        
        
            <div id="ressource"/>
                <h3>Ressource du projet</h3>

                URL d\'accès aux fichiers de description et des données du data challenge: </br>
                <a href="'.$data["urlFichier"].'">'.$data["urlFichier"].'</a></br>
                URL vidéo de présentation du projet: <br />
                <iframe width="355" height="200" src="'.$embedLink.'" frameborder="0" allowfullscreen></iframe>
                
            </div>
            <div id="consignes">
                <h3>Consignes</h3>
                <p>'.$data["consigne"].'</p>
            </div>
            <div id="conseils">
                <h3>Conseils</h3>
                <p>'.$data["conseil"].'</p>
            </div>
        
        
    ';
    if($data["typeEvenement"] == "dataBattle") {

        echo '
            <div id="questionnaire">
                <h3>Questionnaire</h3>
        ';
        if(!(isset($_SESSION['idTeam']))) {
            echo "<p style:color:red>Veuillez creer une équipe</p>";
        }
        else {

            echo '
                    <table>
            ';
                $bool = false;
                for ($i=1; $i < 5; $i++) { 
                    $anwserQuestionnaire = getTeamQuestionnaire($_SESSION['idTeam'],$choixChallenge,$i);

                    echo ' 
                        <tr>
                            <td>Questionnaire n°'.$i.' :</td>
                    ';
                    if(!(empty($anwserQuestionnaire))) {
                        echo '
                            <td>Fini</td>
                        </tr>
                    ';

                        $lastId=$anwserQuestionnaire[0]["idQuestionnaire"];
                    }
                    elseif (!($bool)) {
                        $bool = true;
                        $lastId++;
                        echo '
                            <td>En cours</td>
                            <td><button class="questionnaire" onclick="window.location.href=`./?page=questionnaire&idQuestionnaire='.$lastId.'`">Repondre au questionnaire</button></td>
                            </tr>
                    ';
                    }
                    else {
                        echo '
                            <td>A venir ...</td>
                        </tr>
                    ';
                    }

                    
                }
                    
            echo '
                    </table>
            ';
        }
        echo '
            </div>
        ';
    }
    

    foreach($superviseurs as $i=>$superviseur) {
        $i++;
        echo '

            <h3>Coordonnées contact superviseur '.$i.'</h3>

            <p>Porteur de projet:</p>
            Nom: '.$superviseur["nomUtilisateur"].'<br/>
            Prenom: '.$superviseur["prenomUtilisateur"].'<br/>
            Mail: '.$superviseur["email"].'<br/>
            Tel: '.$superviseur["numeroTel"].'<br/>
        
        ';
    }
?>
        <div id="lienGithub">
            <h3>Deposer votre lien github: </h3>
            <form id="formGithub">
                <input type="text" id="github" name="github" placeholder="lien github" />
                <input type="submit" id="subgithub" name="subgithub" value="Deposer mon code"/>
                

            </form>
        </div>
        <?php echo '
        <div>
            <button onclick="window.location.href=`./?page=analyseCode&Equipe='.$_SESSION["idTeam"].'`">Analyser code</button>
        </div>'; 
        ?>


    </div>
</div>