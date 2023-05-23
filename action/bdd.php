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
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville) 
                    VALUES (:mail, :pass, Etudiant, :nom ,  :prenom , :tel, :niveau ,'" . $ecole . "','". $ville ."')";
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
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel) 
                    VALUES (:mail, :pass, Gestinnaire, :nom ,  :prenom , :tel)";
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
            $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, nomEntreprise, dateDebutUtilisateur, dateFinUtilisateur) 
                    VALUES (:mail, :pass, Gestinnaire, :nom ,  :prenom , :tel, '".$entreprise."', :dateD, :dateF )";
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
            $sqlQuery = "SELECT email, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville, nomEntreprise FROM Utilisateur WHERE email LIKE :email";
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
            $sqlQuery="INSERT INTO Questionnaire(idDataBattle,dateDebut,dateFin) VALUES (:iddatabattle,:dateDebut,:dateFin)";
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
    * Permet de récupérer les réponses d'une équipe à un questionnaire 
    * @param idQuestion : id question lié à la réponse
    * @param idEquipe : id Equipe qui a répondu au questionnaire
    */
    function setReponse($idEquipe,$idQuestion,$reponse){
        try{
            $conn = connect();
            $sqlQuery="UPDATE TABLE reponse WHERE idQuestion=:idQuestion AND idEquipe=:idEquipe SET reponse = :reponse";
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
    function getReponse($idEquipe,$idQuestion){
        try{
            $conn = connect();
            $sqlQuery="SELECT reponse FROM Reponse WHERE idQuestion=:idQuestion AND idEquipe=:idEquipe";
            $statement=$conn->prepare($sqlQuery);
            $statement->bindParam(':idQuestion',$idQuestion);
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
            $sqlQuery="UPDATE TABLE Reponse WHERE idQuestion=:idQuestion AND idEquipe=:idEquipe SET note=:note";
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
            $sqlQuery = "SELECT nomEvenement, dateDebut, dateFin, descriptionEvent, imageEvent FROM Evenement WHERE typeEvenement LIKE 'dataChallenge'";
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
    * Permet de récupérer la liste des data Battle
    * @return tableau de tableau de battle
    */
    function getBattle(){
        try{
            $conn = connect();
            $sqlQuery = "SELECT nomEvenement, dateDebut, dateFin, descriptionEvent, imageEvent FROM Evenement WHERE typeEvenement LIKE 'dataBattle'";
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
    function getProjetData($nomEvenement){
        try{
            $conn = connect();
            $sqlQuery = "SELECT * FROM ProjetData INNER JOIN Evenement ON Evenement.idEvenement = ProjetData.idEvenement WHERE Evenement.nomEvenement LIKE :event";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':event', $nomEvenement);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    
?>
