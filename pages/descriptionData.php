<link rel="stylesheet" href="styles/component/descriptionData.css" />

<div id="description">

<?php

    $datas = getDataProjet($_POST["choixChallenge"]);
    $superviseurs = getSuperviseurUtilisateur($_POST["choixChallenge"]);
    foreach ($datas as $data) {
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


            <h1>'.$data["nomEvenement"].'</h1>

            
            Data challenge du '.$data["dateDebut"].'
            <div id="boutton">
                <button onclick="window.location.href=`./?page=messagerie`">Envoyer un message</button>
                <button onclick="">Créer/gérer mon équipe</button>
            </div>
                <div id="description">
                <h2>'.$data["nomProjet"].': </h2>

                <div id="descriptionProjet"/>
                    '.$data["description"].'
                </div>
                <img src="../'.$data["imageEvent"].'" alt="image du projet"></img>
            </div>
            
            <div id="ressource"/>
                <h3>Ressource du projet</h3>

                URL d\'accès aux fichiers de description et des données du data challenge: </br>
                <a href="'.$data["urlFichier"].'">'.$data["urlFichier"].'</a></br>
                URL vidéo de présentation du projet: <br />
                <iframe width="355" height="200" src="'.$embedLink.'" frameborder="0" allowfullscreen></iframe>
                
            </div>
            <div id="consignes">
                <h3>Consignes</h3>
            </div>
            <div id="conseils">
                <h3>Conseils</h3>
            </div>
            <div>
                <h3>Questionnaire</h3>
                1er questionnaire: ?</br>
                2eme questionnaire:

            </div>
        ';
    }

    foreach($superviseurs as $i=>$superviseur) {
        $i++;
        echo '

            <h3>Coordonnées contact superviseur '.$i.'</h3>

            <p>Porteur de projet:</p>
            Nom: '.$superviseur["nomutilisateur"].'<br/>
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



</div>