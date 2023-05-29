<?php

    require_once('database_login.php');

    /*
    * Permet de se connecter à la base de données
    * @return true En cas de succès
    */
    function connect() {

        $connexion = null;
        global $username; // récupère le nom d'utilisateur
        global $password; // récupère le password
        global $bddname;
        global $port;

        try
        {
            // On se connecte à MySQL    
            $connexion = new PDO(
                'mysql:host=localhost;dbname='.$bddname. ';charset=utf8' .';port=' . $port , $username, $password
            );
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }
        return $connexion;
    }

    // Permet de se déconnecter de la base de données
    function disconnect($conn) {
        $conn->close();
    }

    /*
    * Permet de faire une requête SQL générique
    * @param req : requete SQL
    * @param connexion : variable de connexion
    * @return tableau de valeurs
    */
    function request($req){
        try {
            $connexion = connect();
            $sqlQuery = $req;
            $statement = $connexion->prepare($sqlQuery);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e) {
            return null;
        }
        
    }

    /*
    * Permet de vérifier si l'utilisateur est présent dans la base de données (au moment de la connexion)
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @return true si le nom d'utilisateur est associé au mdp
    */
    function isUser($mail, $pass){
        $conn = connect();
        $sqlQuery = "select `email`, `motDePasse` FROM Utilisateur WHERE email LIKE :mail AND motDePasse LIKE :pass;";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':pass', $pass);
        $statement->execute();
        $result = $statement->rowCount();
        return $result > 0;
    }


    /*
    * Permet d'inscrire un etudiant sur le site
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @param nom
    * @param prenom
    * @param tel
    * @param niv : niveau d'etude (L1, L2, L3, M1, M2, D)
    * @param ecole
    * @param ville
    */
    function addEtudiant($mail, $password, $nom, $prenom, $tel, $niv, $ecole, $ville){
        try{
            $conn = connect();
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville) VALUES (:mail, :pass, 'Etudiant', :nom ,  :prenom , :tel, :niveau ,'" . $ecole . "','". $ville ."')";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':pass', $password);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':tel', $tel);
            $statement->bindParam(':niveau', $niv);
            $statement->execute();
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }
        
    }

    /*
    * Permet d'inscrire un gestionnaire interne à IA PAU sur le site
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @param nom
    * @param prenom
    * @param tel
    */
    function addGestionnaireInterne($mail, $password, $nom, $prenom, $tel){
        try{
            $conn = connect();
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel) VALUES (:mail, :pass, 'Gestionnaire', :nom ,  :prenom , :tel)";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':pass', $password);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':tel', $tel);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet d'inscrire un gestionnaire externe à IA PAU sur le site
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @param nom
    * @param prenom
    * @param tel
    * @param entreprise
    */
    function addGestionnaireExterne($mail, $password, $nom, $prenom, $tel, $entreprise, $dateD, $dateF){
        try{
            $conn = connect();
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, nomEntreprise, dateDebutUtilisateur, dateFinUtilisateur) VALUES (:mail, :pass, 'Gestionnaire', :nom ,  :prenom , :tel, '".$entreprise."', :dateD, :dateF )";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':pass', $password);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':tel', $tel);
            $statement->bindParam(':dateD', $dateD);
            $statement->bindParam(':dateF', $dateF);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de supprimer un utilisateur du site
    * @param mail : mail de l'utilisateur
    */
    function deleteUser($mail){
        try{
            $conn = connect();
            $sqlQuery = "DELETE FROM Utilisateur WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de récupérer les infos d'un utilisateur
    * @param mail : mail de l'utilisateur
    */
    function getUser($mail){
        try{
            $conn = connect();

            $sqlQuery = "SELECT email, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville, nomEntreprise, dateFinUtilisateur FROM Utilisateur WHERE email LIKE :email";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':email', $mail);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le type d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param type : nouveau type de l'utilisateur
    */
    function SetStatus($mail, $type){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET type = :type WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':type', $type);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
 
    /*
    * Permet de modifier le mdp d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param oldPass : ancien password de l'utilisateur
    * @param newPass : nouveau password de l'utilisateur
    */
    function modifyPassword($mail, $oldPass, $newPass){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET motDePasse = :newPass WHERE email LIKE :mail AND motDePasse = :oldPass";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':oldPass', $oldPass);
            $statement->bindParam(':newPass', $newPass);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le prénom d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param username : nouveau prénom de l'utilisateur
    */
    function modifyUsername($mail, $username){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET prenomUtilisateur = :username WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':username', $username);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le nom de famille d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param name : nouveau nom de l'utilisateur
    */
    function modifyName($mail, $name){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET nomUtilisateur = :name WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':name', $name);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le num de tel d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param tel : nouveau num de tel de l'utilisateur
    */
    function modifyTel($mail, $tel){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET tel = :tel WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':tel', $tel);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le niveau d'étude d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param lvl : nouveau niveau d'étude de l'utilisateur
    */
    function modifyLvl($mail, $lvl){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET niveauEtude = :lvl WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':lvl', $lvl);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier le l'ecole d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param ecole : nouvelle école de l'utilisateur
    */
    function modifyEcole($mail, $ecole){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET ecole = :ecole WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':ecole', $ecole);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier la ville d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param ville : nouvelle ville de l'utilisateur
    */
    function modifyVille($mail, $ville){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET ville = :ville WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':ville', $ville);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier la date de fin d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param dateFinUtilisateur : nouvelle date de fin de l'utilisateur
    */
    function modifyDateFinUtilisateur($email, $dateFinUtilisateur){
        try {
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET dateFinUtilisateur = :dateFinUtilisateur WHERE email LIKE :email";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':dateFinUtilisateur', $dateFinUtilisateur);
            $statement->execute();
        }
        catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet de modifier la ville d'un utilisateur
    * @param mail : mail de l'utilisateur
    * @param ville : nouvelle ville de l'utilisateur
    */
    function modifyEntreprise($mail, $entreprise){
        try{
            $conn = connect();
            $sqlQuery = "UPDATE Utilisateur SET entreprise = :entreprise WHERE email LIKE :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':entreprise', $entreprise);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /*
    * Permet d'ajouter un evenement (date battle/challenge)
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @param nom
    * @param prenom
    * @param tel
    * @param entreprise
    */
    function addEvent($nom, $dateDebut, $dateFin, $type){
        try{
            $conn = connect();
            $sqlQuery = "INSERT INTO Evenement (nomEvenement, dateDebut, dateFin, typeEvenement) 
                    VALUES (:nom, :dateD, :dateF, :type)";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':dateD', $dateDebut);
            $statement->bindParam(':dateF', $dateFin);
            $statement->bindParam(':type', $type);
            $statement->execute();
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    /*
    * Permet d'ajouter un questionnaire 
    * @param idDataBattle : id data battle lié au questionnaire
    * @param dateDebut : date de début du questionnaire
    * @param dateFin : date de Fin du questionnaire
    */
    function addEquipe($nom,$idcapitaine,$idprojet){
        try{
            $conn = connect();
            $sqlQuery="INSERT INTO Equipe(nomEquipe,idCapitaine,idProjetData) VALUES (:nom,:idcapitaine,:idprojet)";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':nom',$nom);
            $statement->bindParam(':idcapitaine', $idcapitaine);
            $statement->bindParam(':idprojet', $idprojet);
            $statement->execute();
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
    /*
    * Permet d'ajouter un questionnaire 
    * @param idDataBattle : id data battle lié au questionnaire
    * @param dateDebut : date de début du questionnaire
    * @param dateFin : date de Fin du questionnaire
    */
    function addQuestionnaire($iddatabattle,$dateDebut,$dateFin){
        try{
            $conn = connect();
            $sqlQuery="INSERT INTO Questionnaire(idDataBattle,dateDebut,dateFin) VALUES (:idDataBattle,:dateDebut,:dateFin)";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idDataBattle',$iddatabattle);
            $statement->bindParam(':dateDebut', $dateDebut);
            $statement->bindParam(':dateFin', $dateFin);
            $statement->execute();
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }


    /*
    * Permet de récupérer un questionnaire associé à une data battle
    * @param idDataBattle : id data battle lié au questionnaire
    */
    function getQuestionnaire($iddatabattle, $numero){
        try{
            $conn = connect();
            $sqlQuery="SELECT idQuestionnaire, idDataBattle, numero, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin FROM Questionnaire WHERE idDataBattle = :id AND numero = :numero ";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':id',$iddatabattle);
            $statement->bindParam(':numero',$numero);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }

    /*
    * Permet de récupérer un questionnaire associé à une data battle
    * @param idDataBattle : id data battle lié au questionnaire
    */
    function isQuestionnaire($iddatabattle, $numero){
        try{
            $conn = connect();
            $sqlQuery="SELECT * FROM Questionnaire WHERE idDataBattle = :id AND numero = :numero ";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':id',$iddatabattle);
            $statement->bindParam(':numero',$numero);
            $statement->execute();
            $result = $statement->rowCount();
            return $result > 0;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
 
    /*
    * Permet d'ajouter une question à un questionnaire 
    * @param idQuestionnaire : id questionnaire lié à la question
    * @param intitule : intitulé de la question
    */
    function addQuestion($idQuestionnaire,$intitule){
        try{
            $conn = connect();
            $sqlQuery="INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (:idQuestionnaire,:intitule)";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestionnaire',$idQuestionnaire);
            $statement->bindParam(':intitule', $intitule);
            $statement->execute();
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
 
    /*
    * Permet de récupérer les questions d'un questionnaire 
    * @param idQuestionnaire : id questionnaire lié à la question
    * @param intitule : intitulé de la question
    */
    function getQuestion($idQuestionnaire){
        try{
            $conn = connect();
            $sqlQuery="SELECT intituleQuestion FROM Question WHERE idQuestionnaire=:idQuestionnaire";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestionnaire',$idQuestionnaire);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
    /*
    * Permet de récupérer les dates d'un questionnaire 
    * @param idQuestionnaire : id questionnaire dont on veut les dates
    */
    function getDatesQuestionnaire($idQuestionnaire){
        try{
            $conn = connect();
            $sqlQuery="SELECT DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin FROM Questionnaire WHERE idQuestionnaire=:idQuestionnaire";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestionnaire',$idQuestionnaire);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
    /*
    * Permet de récupérer les dates d'un questionnaire 
    * @param idQuestionnaire : id questionnaire dont on veut les dates
    */
    function getDatesDataBattle($idDataBattle){
        try{
            $conn = connect();
            $sqlQuery="SELECT DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin FROM Evenement WHERE idEvenement=:idDataBattle";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idDataBattle',$idDataBattle);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }
    /*
    * Permet de récupérer les réponses d'une équipe à un questionnaire 
    * @param idQuestion : id question lié à la réponse
    * @param idEquipe : id Equipe qui a répondu au questionnaire
    */
    function setReponse($idEquipe,$idQuestion,$reponse){
        try{
            $conn = connect();
            $sqlQuery="INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (:idQuestion,:idEquipe,:reponse,NULL)";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestion',$idQuestion);
            $statement->bindParam(':idEquipe',$idEquipe);
            $statement->bindParam(':idEquipe',$idEquipe);
            $statement->bindParam(':reponse',$reponse);
            $statement->execute();
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }    
    /*
    * Permet de récupérer les réponses d'une équipe à un questionnaire 
    * @param idQuestion : id question lié à la réponse
    * @param idEquipe : id Equipe qui a répondu au questionnaire
    */

    function getReponses($idEquipe,$idQuestionnaire){
        try{
            $conn = connect();
            $sqlQuery="SELECT reponse FROM Reponse,Question WHERE Reponse.idQuestion=Question.idQuestion AND Question.idQuestionnaire=:idQuestionnaire AND Reponse.idEquipe=:idEquipe";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestionnaire',$idQuestionnaire);
            $statement->bindParam(':idEquipe',$idEquipe);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }

    /*
    * Permet de noter une réponse d'une équipe à un questionnaire 
    * @param idQuestion : id question lié à la réponse
    * @param idEquipe : id Equipe qui a répondu au questionnaire
    * @param note : note attribué à la réponse
    */
    function noterReponse($idEquipe,$idQuestion,$note){
        try{
            $conn = connect();
            $sqlQuery="UPDATE Reponse SET note=:note WHERE idQuestion=:idQuestion AND idEquipe=:idEquipe";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestion',$idQuestion);
            $statement->bindParam(':idEquipe',$idEquipe);
            $statement->bindParam(':note',$note);
            $statement->execute();
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }

    function getNoteEquipe($idEquipe,$idQuestionnaire){
        try{
            $conn = connect();
            $sqlQuery="Select SUM(note) FROM Reponse R,Question Q WHERE idEquipe =:idEquipe AND R.idQuestion=Q.idQuestion AND Q.idQuestionnaire=:idQuestionnaire";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestionnaire',$idQuestionnaire);
            $statement->bindParam(':idEquipe',$idEquipe);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }    
    }

        /*
    * Permet d'ajouter un projet Data
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @param nom
    * @param prenom
    * @param tel
    * @param entreprise
    */
    function addProjetData($idEvenement, $nomProjet, $description, $image, $urlFichier, $urlVideo){
        try{
            $conn = connect();
            $sqlQuery = "INSERT INTO ProjetData (idEvenement, nomProjet, description, image, urlFichier, urlVideo) 
                    VALUES (:id, :nom, :desc, :img, :fichier, :video)";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':id', $idEvenement);
            $statement->bindParam(':nom', $nomProjet);
            $statement->bindParam(':desc', $description);
            $statement->bindParam(':img', $image);
            $statement->bindParam(':fichier', $urlFichier);
            $statement->bindParam(':video', $urlVideo);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    
    /*
    * Permet de récupérer la liste des data Challenge
    * @return tableau de tableau de challenge
    */
    function getChallenge(){
        try{
            $conn = connect();
            $sqlQuery = "SELECT idEvenement, nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent FROM Evenement WHERE typeEvenement LIKE 'dataChallenge'";
            $statement = $conn->prepare($sqlQuery);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

        /*
    * Permet de récupérer un data Challenge ou une data battle à l'aide de son id
    * @return tableau de challenge
    */
    function getEvenementbyID($id){
        try{
            $conn = connect();
            $sqlQuery = "SELECT idEvenement, nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent FROM Evenement WHERE idEvenement = :id";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    /*
    * Permet de récupérer la liste des data Battle
    * @return tableau de tableau de battle
    */
    function getBattle(){
        try{
            $conn = connect();
            $sqlQuery = "SELECT idEvenement, nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent FROM Evenement WHERE typeEvenement LIKE 'dataBattle'";
            $statement = $conn->prepare($sqlQuery);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    /*
    * Permet de récupérer les infos liées à un projet Data 
    * @param nomEvenement : nom de l'evenement correspondant
    */
    function getProjetData($idEvenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT * FROM ProjetData 
                        WHERE idEvenement LIKE :idEvenement";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idEvenement', $idEvenement);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    /*
    * Permet de récupérer les équipes de l'utilisateur 
    * @param mail : m
    */
    function getEquipeUser($mail){
        try{
            $conn = connect();
            $sqlQuery = "SELECT Equipe.nomEquipe, Equipe.idEquipe FROM Equipe 
                        INNER JOIN Composer ON Equipe.idEquipe = Composer.idEquipe 
                        INNER JOIN Utilisateur ON Composer.idEtudiant = Utilisateur.idUtilisateur 
                        WHERE Utilisateur.email = :mail";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

        /*
    * Permet de récupérer les équipes associés à un challenge/battle 
    * @param mail : 
    */
    function getEquipesEvenement($idEvenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT DISTINCT e.nomEquipe, e.idEquipe
                        FROM Equipe AS e
                        INNER JOIN ProjetData AS pd ON e.idProjetData = pd.idProjetData
                        WHERE pd.idEvenement = :idEvenement";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idEvenement', $idEvenement);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

            /*
    * Permet de récupérer les équipes associés à un projet 
    * @param mail : 
    */
    function getEquipesProjet($idProjet){
        try{
            $conn = connect();
            $sqlQuery = "SELECT DISTINCT e.nomEquipe, e.idEquipe
                        FROM Equipe
                        WHERE idProjetData = :idProjet";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idProjet', $idProjet);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false; // En cas d'erreur, renvoyer false
        }
    }

                /*
    * Permet de récupérer les projets associés à un datachallenge/battle 
    * @param 
    */
    function getProjetsEvenement($idEvenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT nomProjet, idProjetData
                        FROM ProjetData
                        WHERE idEvenement = :idEvenement";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idEvenement', $idEvenement);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false; // En cas d'erreur, renvoyer false
        }
    }

        /*
    * Permet de récupérer les membres d'une équipe
    * @param mail : 
    */
    function getMembre($equipe){
        try{
            $conn = connect();
            $sqlQuery = "SELECT Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur FROM Utilisateur 
                        INNER JOIN Composer ON Utilisateur.idUtilisateur = Composer.idEtudiant 
                        INNER JOIN Equipe ON Composer.idEquipe = Equipe.idEquipe 
                        WHERE Equipe.nomEquipe = :equipe";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':equipe', $equipe);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false; // En cas d'erreur, renvoyer false
        }
    }

    /*
    * Permet de récupérer le gestionnaire d'un projet
    * @param mail : 
    */
    function getSuperviseur($projet){
        try{
            $conn = connect();
            $sqlQuery = "SELECT Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Utilisateur.email FROM Utilisateur
                        INNER JOIN Superviser ON Utilisateur.idUtilisateur = Superviser.idGestionnaire
                        INNER JOIN ProjetData ON Superviser.idProjetData = ProjetData.idProjetData
                        WHERE ProjetData.nomProjet LIKE '".$projet."' ;";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':projet', $projet);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }
    /*
    * Permet de récupérer les projets gérés par un gestionnaire
    * @param mail : 
    */
    function getGestionnaireProjet($gestio){
        try{
            $conn = connect();
            $sqlQuery = "SELECT ProjetData.nomProjet
                        FROM ProjetData
                        INNER JOIN Superviser ON ProjetData.idProjetData = Superviser.idProjetData
                        INNER JOIN Utilisateur ON Superviser.idGestionnaire = Utilisateur.idUtilisateur
                        WHERE Utilisateur.nomUtilisateur = :gestio;";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':gestio', $gestio);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    /*
    * Permet de checker si un étudiant est inscrit à un des projet du challenge
    * @param mail : 
    */
    function checkInscriptionProjet($mail, $evenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT COUNT(*) AS count
                        FROM Utilisateur AS u
                        INNER JOIN Composer AS c ON u.idUtilisateur = c.idEtudiant
                        INNER JOIN Equipe AS e ON c.idEquipe = e.idEquipe
                        INNER JOIN ProjetData AS pd ON e.idProjetData = pd.idProjetData
                        INNER JOIN Evenement AS ev ON pd.idEvenement = ev.idEvenement
                        WHERE u.email = :mail AND ev.nomEvenement = :evenement";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':evenement', $evenement);
            $statement->execute();

            $result = $statement->fetch();
            $count = $result['count'];
            // Vérification de l'inscription
            if ($count > 0) {
                return true; // L'étudiant est inscrit au projet
            } else {
                return false; // L'étudiant n'est pas inscrit au projet
            }
        }
        catch(Exception $e){
            echo 'Erreur : ' . $e->getMessage();
            return false; // En cas d'erreur, renvoyer false
        }
    }


    /*
    * Permet de checker si un gestionnaire supervise un des projet du challenge
    * @param mail : 
    */
    function checkGestionnaireProjet($mail, $evenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT COUNT(*) AS count
                        FROM Utilisateur AS u
                        INNER JOIN Superviser AS s ON u.idUtilisateur = s.idGestionnaire
                        INNER JOIN ProjetData AS pd ON s.idProjetData = pd.idProjetData
                        INNER JOIN Evenement AS ev ON pd.idEvenement = ev.idEvenement
                        WHERE u.email = :mail AND ev.nomEvenement = :nomEvenement";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':nomEvenement', $evenement);
            $statement->execute();

            $result = $statement->fetch();
            $count = $result['count'];
            // Vérification de l'inscription
            if ($count > 0) {
                return true; // Le gestionnaire est superviseur d'un projet
            } else {
                return false; // Le gestionnaire n'est  pas superviseur d'un projet
            }
        }
        catch(Exception $e){
            echo 'Erreur : ' . $e->getMessage();
            return false; // En cas d'erreur, renvoyer false
        }
    }
  
?>
