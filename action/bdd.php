<?php

require_once('database_login.php');

/*
 * Permet de se connecter à la base de données
 * @return true En cas de succès
 */
function connect()
{

    $connexion = null;
    global $username; // récupère le nom d'utilisateur
    global $password; // récupère le password
    global $bddname;
    global $port;

    try {
        // On se connecte à MySQL    
        $connexion = new PDO(
            'mysql:host=localhost;dbname=' . $bddname . ';charset=utf8' . ';port=' . $port,
            $username,
            $password
        );
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    return $connexion;
}

    /*Connexion en procedural*/
    function conn2() {
        global $username; // récupère le nom d'utilisateur
        global $password; // récupère le password
        global $servername;
        $cnx = mysqli_connect($servername, $username, $password);
        if (mysqli_connect_errno()) {
            echo "Erreur de connexion a MySQL: " . mysqli_connect_error();
            exit();
        }
        return $cnx;
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
function request($req)
{
    try {
        $connexion = connect();
        $sqlQuery = $req;
        $statement = $connexion->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        return null;
    }

}
/*
* Permet de verifier si un mail existe dans la base de données
* @param mail : mail de l'utilisateur
* @return true si le mail existe
*/
function isMail($mail)
{

    try {
        
        $conn = connect();

        $sqlQuery = "SELECT `email` FROM Utilisateur WHERE email LIKE :mail;";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetch();
        return $result > 0;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


}


/*
 * Permet de vérifier si l'utilisateur est présent dans la base de données (au moment de la connexion)
 * @param mail : mail de l'utilisateur
 * @param pass : Mot de passe
 * @return true si le nom d'utilisateur est associé au mdp
 */
function isUser($mail, $pass)
{
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
function addEtudiant($mail, $password, $nom, $prenom, $tel, $niv, $ecole, $ville)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville) 
                    VALUES (:mail, :pass, 'Etudiant', :nom ,  :prenom , :tel, :niveau , :ecole , :ville)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':pass', $password);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':tel', $tel);
        $statement->bindParam(':niveau', $niv);
        $statement->bindParam(':ecole', $ecole);
        $statement->bindParam(':ville', $ville);
        $statement->execute();
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
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
function addGestionnaireInterne($mail, $password, $nom, $prenom, $tel)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel) 
                    VALUES (:mail, :pass, 'Gestionnaire', :nom ,  :prenom , :tel)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':pass', $password);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':tel', $tel);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
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
function addGestionnaireExterne($mail, $password, $nom, $prenom, $tel, $entreprise, $dateD, $dateF)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, nomEntreprise, dateDebutUtilisateur, dateFinUtilisateur) 
                    VALUES (:mail, :pass, 'Gestionnaire', :nom ,  :prenom , :tel, '" . $entreprise . "', :dateD, :dateF )";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':pass', $password);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':tel', $tel);
        $statement->bindParam(':dateD', $dateD);
        $statement->bindParam(':dateF', $dateF);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de supprimer un utilisateur du site
 * @param mail : mail de l'utilisateur
 */
function deleteUser($mail)
{
    try {
        $conn = connect();
        $sqlQuery = "DELETE FROM Utilisateur WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de récupérer les infos d'un utilisateur
 * @param mail : mail de l'utilisateur
 */
function getUser($mail)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT * FROM Utilisateur WHERE email LIKE :email";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':email', $mail);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
* Permet de récupérer les infos de tous les Etudiants et Gestionnaires

*/
function getAllUsers()
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT email, motDePasse,type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude, ecole, ville, nomEntreprise, dateDebutUtilisateur, dateFinUtilisateur FROM Utilisateur WHERE type LIKE 'Etudiant' OR type LIKE 'Gestionnaire'";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}



/*
 * Permet de modifier le type d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param type : nouveau type de l'utilisateur
 */
function SetStatus($mail, $type)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET type = :type WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':type', $type);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le mdp d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param oldPass : ancien password de l'utilisateur
 * @param newPass : nouveau password de l'utilisateur
 */
function modifyPassword($mail, $oldPass, $newPass)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET motDePasse = :newPass WHERE email LIKE :mail AND motDePasse = :oldPass";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':oldPass', $oldPass);
        $statement->bindParam(':newPass', $newPass);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}



/*
 * Permet de modifier le prénom d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param username : nouveau prénom de l'utilisateur
 */
function modifyUsername($mail, $username)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET prenomUtilisateur = :username WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':username', $username);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom de famille d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom de l'utilisateur
 */
function modifyName($mail, $name)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET nomUtilisateur = :name WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':name', $name);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier l'email d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param newMail : nouveau mail de l'utilisateur
 */
function modifyEmail($mail, $newMail)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET email = :newMail WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':newMail', $newMail);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet de modifier le num de tel d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param tel : nouveau num de tel de l'utilisateur
 */
function modifyTel($mail, $tel)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET numeroTel = :tel WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':tel', $tel);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le type d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param type : nouveau type de l'utilisateur
 */
function modifyType($mail, $type)
{
    try {
        $conn = connect();
        deleteInfo($mail);
        $sqlQuery = "UPDATE Utilisateur SET type = :type WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':type', $type);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de supprimer les infos propres à un étudiant (niveau d'étude, école, ville) et a un gestionnaire (nom entreprise, date de debut, date de fin)
 * @param mail : mail de l'utilisateur
 */
function deleteInfo($mail)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET niveauEtude = NULL, ecole = NULL, ville = NULL, nomEntreprise = NULL, dateDebutUtilisateur = NULL, dateFinUtilisateur = NULL WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

/*
 * Permet de modifier le niveau d'étude d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param lvl : nouveau niveau d'étude de l'utilisateur
 */
function modifyLvl($mail, $lvl)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET niveauEtude = :lvl WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':lvl', $lvl);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
    }
}

/*
 * Permet de modifier le l'ecole d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param ecole : nouvelle école de l'utilisateur
 */
function modifyEcole($mail, $ecole)
{
    echo $ecole;
    echo $mail;
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET ecole = :ecole WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':ecole', $ecole);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
    }
    $infos = getUser($mail);
    $ecolee = $infos[0]['ecole'];
    echo 'ecole est : ';
    echo $ecolee;
}

/*
 * Permet de modifier la ville d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param ville : nouvelle ville de l'utilisateur
 */
function modifyVille($mail, $ville)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET ville = :ville WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':ville', $ville);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
    }
}
/*
 * Permet de modifier la date de debut d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param dateFinUtilisateur : nouvelle date de debut de l'utilisateur
 */
function modifyDateDebutUtilisateur($email, $dateDebutUtilisateur)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET dateDebutUtilisateur = :dateDebutUtilisateur WHERE email LIKE :email";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':dateDebutUtilisateur', $dateDebutUtilisateur);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
    }
}

/*
 * Permet de modifier la date de fin d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param dateFinUtilisateur : nouvelle date de fin de l'utilisateur
 */
function modifyDateFinUtilisateur($email, $dateFinUtilisateur)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET dateFinUtilisateur = :dateFinUtilisateur WHERE email LIKE :email";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':dateFinUtilisateur', $dateFinUtilisateur);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet de modifier la ville d'un utilisateur
 * @param mail : mail de l'utilisateur
 * @param ville : nouvelle ville de l'utilisateur
 */
function modifyEntreprise($mail, $nomEntreprise)
{
    echo $nomEntreprise;
    echo $mail;
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Utilisateur SET nomEntreprise = :nomEntreprise WHERE email LIKE :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':nomEntreprise', $nomEntreprise);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $errorInfo = $statement->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo 'Erreur : ' . $errorInfo[2];
    }
}

/*
 * Permet d'ajouter un evenement (date battle/challenge)
 */
function addEvent($nom, $dateDebut, $dateFin, $type, $descriptionEvent, $imageEvent)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Evenement (nomEvenement, dateDebut, dateFin, typeEvenement, descriptionEvent, imageEvent) 
                    VALUES (:nom, :dateD, :dateF, :type, :descriptionEvent, :imageEvent)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':dateD', $dateDebut);
        $statement->bindParam(':dateF', $dateFin);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':descriptionEvent', $descriptionEvent);
        $statement->bindParam(':imageEvent', $imageEvent);
        $statement->execute();

        // Récupération de l'id de l'événement ajouté
        $eventId = $conn->lastInsertId();

        return $eventId;

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de supprimer un evenement du site
 */
function deleteEvent($idEvent)
{
    try {
        $conn = connect();
        $sqlQuery = "DELETE FROM Evenement WHERE idEvenement = :idEvent";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvent', $idEvent);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de supprimer un evenement du site
 */
function deleteProjet($idProjet)
{
    try {
        $conn = connect();
        $sqlQuery = "DELETE FROM ProjetData WHERE idProjetData = :idProjet";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjet', $idProjet);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateNomEvent($idEvenement, $nom)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Evenement SET nomEvenement = :nom WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->bindParam(':nom', $nom);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateDateD($idEvenement, $dateDebut)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Evenement SET dateDebut = :dateDebut WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->bindParam(':dateDebut', $dateDebut);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateDateF($idEvenement, $dateFin)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Evenement SET dateDebut = :dateFin WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->bindParam(':dateFin', $dateFin);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateDescriptionEvent($idEvenement, $descriptionEvent)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Evenement SET descriptionEvent = :descriptionEvent WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->bindParam(':descriptionEvent', $descriptionEvent);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateImageEvent($idEvenement, $imageEvent)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Evenement SET imageEvent = :imageEvent WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->bindParam(':descriptionEvent', $imageEvent);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateNomProjet($idProjetData, $nomProjet)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET nomProjet = :nomProjet WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':nomProjet', $nomProjet);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateDescProjet($idProjetData, $description)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET description = :description WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':description', $description);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
* Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateimageProjet($idProjetData, $image)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET image = :image WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':image', $image);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */

function updatefichierProjet($idProjetData, $urlFichier)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET urlFichier = :urlFichier WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':urlFichier', $urlFichier);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */

function updateVideoProjet($idProjetData, $urlVideo)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET urlVideo = :urlVideo WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':urlVideo', $urlVideo);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */

function updateConseilProjet($idProjetData, $conseil)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET conseil = :conseil WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':conseil', $conseil);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de modifier le nom d'un event
 * @param mail : mail de l'utilisateur
 * @param name : nouveau nom
 */
function updateConsigneProjet($idProjetData, $consigne)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE ProjetData SET consigne = :consigne WHERE idProjetData = :idProjetData";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjetData', $idProjetData);
        $statement->bindParam(':consigne', $consigne);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet d'ajouter un questionnaire 
 * @param idDataBattle : id data battle lié au questionnaire
 * @param dateDebut : date de début du questionnaire
 * @param dateFin : date de Fin du questionnaire
 */
function addEquipe($nom, $idcapitaine, $idprojet)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Equipe(nomEquipe,idCapitaine,idProjetData) VALUES (:nom,:idcapitaine,:idprojet)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':idcapitaine', $idcapitaine);
        $statement->bindParam(':idprojet', $idprojet);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet d'ajouter un questionnaire 
 * @param idDataBattle : id data battle lié au questionnaire
 * @param dateDebut : date de début du questionnaire
 * @param dateFin : date de Fin du questionnaire
 */
function addQuestionnaire($iddatabattle, $dateDebut, $dateFin)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Questionnaire(idDataBattle,dateDebut,dateFin) VALUES (:iddatabattle,:dateDebut,:dateFin)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idDataBattle', $iddatabattle);
        $statement->bindParam(':dateDebut', $dateDebut);
        $statement->bindParam(':dateFin', $dateFin);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


    /*
    * Permet de récupérer un questionnaire associé à une data battle
    * @param idDataBattle : id data battle lié au questionnaire
    */
    function getQuestionnaire($iddatabattle, $numero){
        try{
            $conn = connect();
            $sqlQuery="SELECT idQuestionnaire, idDataBattle, numero, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin 
            FROM Questionnaire 
            WHERE idDataBattle = :id AND numero = :numero ";
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
 * Permet de supprimer un questionnaire du site
 * @param mail : mail de l'utilisateur
 */
function deleteQuestionnaire($idQuestionnaire)
{
    try {
        $conn = connect();
        $sqlQuery = "DELETE FROM Questionnaire WHERE idQuestionnaire = :idQuestionnaire";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestionnaire', $idQuestionnaire);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de récupérer les dates d'un questionnaire 
 * @param idQuestionnaire : id questionnaire dont on veut les dates
 */
function getDatesQuestionnaire($idQuestionnaire)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin FROM Questionnaire WHERE idQuestionnaire=:idQuestionnaire";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestionnaire', $idQuestionnaire);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de récupérer les questions d'un questionnaire 
 * @param idQuestionnaire : id questionnaire lié à la question
 * @param intitule : intitulé de la question
 */
function getQuestion($idQuestionnaire)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT intituleQuestion,idQuestion FROM Question WHERE idQuestionnaire=:idQuestionnaire";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestionnaire', $idQuestionnaire);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet de récupérer un questionnaire associé à une data battle
 * @param idDataBattle : id data battle lié au questionnaire
 */
function isQuestionnaire($iddatabattle, $numero)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT * FROM Questionnaire WHERE idDataBattle = :id AND numero = :numero ";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':id', $iddatabattle);
        $statement->bindParam(':numero', $numero);
        $statement->execute();
        $result = $statement->rowCount();
        return $result > 0;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de récupérer les dates d'un questionnaire 
 * @param idQuestionnaire : id questionnaire dont on veut les dates
 */
function getDatesDataBattle($idDataBattle)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT DATE_FORMAT(dateDebut, '%d %M %Y') AS dateDebut,DATE_FORMAT(dateFin, '%d %M %Y') AS dateFin FROM Evenement WHERE idEvenement=:idDataBattle";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idDataBattle', $idDataBattle);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
    /*
    * Permet de récupérer les réponses d'une équipe à un questionnaire 
    * @param idQuestion : id question lié à la réponse
    * @param idEquipe : id Equipe qui a répondu au questionnaire
    * TODO:Rajouter le numero dans l'insertion mais il faut faire ca dans la table jsp faire
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
 * Permet d'ajouter une question à un questionnaire 
 * @param idQuestionnaire : id questionnaire lié à la question
 * @param intitule : intitulé de la question
 */
function addQuestion($idQuestionnaire, $intitule)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (:idQuestionnaire,:intitule)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestionnaire', $idQuestionnaire);
        $statement->bindParam(':intitule', $intitule);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
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
function noterReponse($idEquipe, $idQuestion, $note)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Reponse WHERE idQuestion=:idQuestion AND idEquipe=:idEquipe SET note=:note";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestion', $idQuestion);
        $statement->bindParam(':idEquipe', $idEquipe);
        $statement->bindParam(':note', $note);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getNoteEquipe($idEquipe, $idQuestionnaire)
{
    try {
        $conn = connect();
        $sqlQuery = "Select SUM(note) FROM Reponse R,Question Q WHERE idEquipe =:idEquipe AND R.idQuestion=Q.idQuestion AND Q.idQuestionnaire=:idQuestionnaire";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idQuestionnaire', $idQuestionnaire);
        $statement->bindParam(':idEquipe', $idEquipe);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getPodium($idEvenement)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT Equipe.nomEquipe, SUM(Reponse.note) AS totalNotes
                FROM Equipe
                INNER JOIN Reponse ON Equipe.idEquipe = Reponse.idEquipe
                INNER JOIN Question ON Reponse.idQuestion = Question.idQuestion
                INNER JOIN Questionnaire ON Question.idQuestionnaire = Questionnaire.idQuestionnaire
                WHERE Questionnaire.idDataBattle = :idEvenement
                GROUP BY Equipe.nomEquipe
                ORDER BY totalNotes DESC";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
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
function addProjetData($idEvenement, $nomProjet, $description, $image, $urlFichier, $urlVideo, $conseil, $consigne)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO ProjetData (idEvenement, nomProjet, description, image, urlFichier, urlVideo, conseil, consigne) 
                    VALUES (:id, :nom, :desc, :img, :fichier, :video, :conseil, :consigne)";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':id', $idEvenement);
        $statement->bindParam(':nom', $nomProjet);
        $statement->bindParam(':desc', $description);
        $statement->bindParam(':img', $image);
        $statement->bindParam(':fichier', $urlFichier);
        $statement->bindParam(':video', $urlVideo);
        $statement->bindParam(':conseil', $conseil);
        $statement->bindParam(':consigne', $consigne);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
    * Permet de récupérer la liste des data Challenge
    * @return tableau de tableau de challenge
    */
    function getChallenge(){
        try{
            $conn = connect();
            $sqlQuery = "SELECT nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent,idEvenement FROM Evenement WHERE typeEvenement LIKE 'dataChallenge' ORDER BY dateD DESC";
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
            $sqlQuery = "SELECT nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent,idEvenement  FROM Evenement WHERE typeEvenement LIKE 'dataBattle' ORDER BY dateD DESC";
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
function getEvenementbyID($id)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT idEvenement, nomEvenement, DATE_FORMAT(dateDebut, '%d %M %Y') AS dateD, DATE_FORMAT(dateFin, '%d %M %Y') AS dateF, descriptionEvent, imageEvent FROM Evenement WHERE idEvenement = :id";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
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
            $result = $statement->fetch();
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
    function getProjetDatabyID($idProjetData){
        try{
            $conn = connect();
            $sqlQuery = "SELECT * FROM ProjetData 
                        WHERE idProjetData LIKE :idProjetData";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idProjetData', $idProjetData);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        } 
    }

    /*
    * Permet de récupérer les infos d'un challenge qui est lié à un projet Data
    */
    function getEvenementbyProjet($idProjet){
        try{
            $conn = connect();
            $sqlQuery = "SELECT Evenement.*
                        FROM Evenement
                        INNER JOIN ProjetData ON Evenement.idEvenement = ProjetData.idEvenement
                        WHERE ProjetData.idProjetData = :idProjet";
            $statement = $conn->prepare($sqlQuery);
            $statement->bindParam(':idProjet', $idProjet);
            $statement->execute();
            $result = $statement->fetch();
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
function getEquipeUser($mail)
{
    try {
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
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de récupérer les équipes associés à un challenge/battle 
 * @param mail : 
 */
function getEquipesEvenement($idEvenement)
{
    try {
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
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet de récupérer les équipes associés à un projet 
 * @param mail : 
 */
function getEquipesProjet($idProjet)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT DISTINCT e.nomEquipe, e.idEquipe
                        FROM Equipe e
                        WHERE idProjetData = :idProjet";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjet', $idProjet);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/*
 * Permet de récupérer les projets associés à un datachallenge/battle 
 * @param 
 */
function getProjetsEvenement($idEvenement)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT nomProjet, idProjetData
                        FROM ProjetData
                        WHERE idEvenement = :idEvenement";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEvenement', $idEvenement);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/*
 * Permet de récupérer les projets associés à un datachallenge/battle 
 * @param 
 */
function getProjetbyID($idProjet)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT *
                        FROM ProjetData
                        WHERE idProjetData = :idProjet";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idProjet', $idProjet);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}
/*
 * Permet de récupérer les membres d'une équipe
 * @param mail : 
 */
function getMembre($equipe)
{
    try {
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
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/*
 * Permet de récupérer le gestionnaire d'une équipe
 * @param mail : 
 */
function getSuperviseur($projet)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT Utilisateur.* FROM Utilisateur
                        INNER JOIN Superviser ON Utilisateur.idUtilisateur = Superviser.idGestionnaire
                        INNER JOIN ProjetData ON Superviser.idProjetData = ProjetData.idProjetData
                        WHERE ProjetData.nomProjet = :projet;";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':projet', $projet);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
 * Permet de récupérer le gestionnaire d'une équipe
 * @param mail : 
 */
function getGestionnaireProjet($gestio)
{
    try {
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
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * permet de récupérer les projets d'un utilisateur
 * @param $mail : mail de l'utilisateur
 */
function getProjetUser($mail)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT ProjetData.nomProjet, ProjetData.idProjetData FROM ProjetData 
                        INNER JOIN Equipe ON ProjetData.idProjetData = Equipe.idProjetData 
                        INNER JOIN Composer ON Equipe.idEquipe = Composer.idEquipe 
                        INNER JOIN Utilisateur ON Composer.idEtudiant = Utilisateur.idUtilisateur 
                        WHERE Utilisateur.email = :mail";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

/**
 * @fn function getData()
 * @param idChallenge l'id du challenge
 * @return Toutes les data liées à l'événement
 * @brief Permet de récupérer toutes les informations d'un événement Data en fonction de l'id du challenge
 */
function getData($idChallenge)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer les données de l'événement spécifié
        $sqlQuery = "SELECT * from ProjetData 
                        INNER JOIN Evenement ON Evenement.idEvenement = ProjetData.idEvenement 
                        WHERE ProjetData.idEvenement = $idChallenge";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getDataProjet($idProjet)
 * @param idProjet l'id du projet
 * @return Toutes les data liées au projet
 * @brief Permet de récupérer toutes les données du projet en fonction de son id
 */
function getDataProjet($idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer les données du projet spécifié
        $sqlQuery = "SELECT * from ProjetData 
            INNER JOIN Evenement ON Evenement.idEvenement = ProjetData.idEvenement 
            WHERE ProjetData.idProjetData = $idProjet;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getSuperviseurUtilisateur($idProjet)
 * @param idProjet id du projet
 * @return les infos du superviseur du projet
 * @brief Permet de récupérer les informations sur le superviseur du projet
 */
function getSuperviseurUtilisateur($idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer les informations sur le superviseur du projet spécifié
        $sqlQuery = "SELECT * FROM Superviser 
            INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Superviser.idGestionnaire 
            WHERE idProjetData = $idProjet;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/**
 * @fn function verifEquipe($idUtilisateur, $idProjet)
 * @param idUtilisateur l'id de l'utilisateur
 * @param idProjet l'id du projet
 * @return les informations sur l'équipe
 * @brief Permet de vérifier si l'utilisateur fait partie de l'équipe du projet spécifié
 */
function verifEquipe($idUtilisateur, $idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour vérifier si l'utilisateur fait partie de l'équipe du projet spécifié
        $sqlQuery = "SELECT * FROM Equipe
            INNER JOIN Composer ON Composer.idEquipe = Equipe.idEquipe 
            WHERE Composer.idEtudiant = $idUtilisateur
            AND idProjetData = $idProjet;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getAllMemberTeam($idTeam)
 * @param idTeam l'id de l'équipe
 * @return Tous les membres de l'équipe
 * @brief Permet de récupérer tous les membres d'une équipe spécifiée
 */
function getAllMemberTeam($idTeam)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer tous les membres de l'équipe spécifiée
        $sqlQuery = "SELECT * 
            FROM Composer 
            INNER JOIN Equipe ON Equipe.idEquipe = Composer.idEquipe 
            INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Composer.idEtudiant
            WHERE Composer.idEquipe = $idTeam;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getInfoManageTeam($idUtilisateur, $idProjet)
 * @param idUtilisateur l'id de l'utilisateur
 * @param idProjet l'id du projet
 * @return les informations sur le gestionnaire de l'équipe
 * @brief Permet de récupérer les informations sur le gestionnaire de l'équipe du projet spécifié
 */
function getInfoManageTeam($idUtilisateur, $idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer les informations sur le gestionnaire de l'équipe du projet spécifié
        $sqlQuery = "SELECT * 
            FROM Composer 
            INNER JOIN Equipe ON Equipe.idEquipe = Composer.idEquipe 
            INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Equipe.idCapitaine
            INNER JOIN ProjetData ON ProjetData.idProjetData = Equipe.idProjetData
            WHERE Utilisateur.idUtilisateur = $idUtilisateur AND Equipe.idProjetData = $idProjet;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function suppUserTeam($idUser, $idTeam)
 * @param idUser l'id de l'utilisateur
 * @param idTeam l'id de l'équipe
 * @brief Supprime un utilisateur de l'équipe spécifiée
 */
function suppUserTeam($idUser, $idTeam)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour supprimer un utilisateur de l'équipe spécifiée
        $sqlQuery = "DELETE FROM Composer
            WHERE idEtudiant = $idUser AND idEquipe = $idTeam;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function verifSuppUser($idUser, $idTeam)
 * @param idUser l'id de l'utilisateur
 * @param idTeam l'id de l'équipe
 * @return les informations sur l'utilisateur
 * @brief Vérifie si l'utilisateur spécifié est membre de l'équipe spécifiée
 */
function verifSuppUser($idUser, $idTeam)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour vérifier si l'utilisateur spécifié est membre de l'équipe spécifiée
        $sqlQuery = "SELECT * 
            FROM Utilisateur 
            INNER JOIN Composer ON Composer.idEtudiant = Utilisateur.idUtilisateur 
            WHERE idEtudiant = $idUser AND idEquipe = $idTeam;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function searchStudent($query)
 * @param query la requête de recherche
 * @return les résultats de la recherche
 * @brief Recherche des étudiants correspondant à la requête spécifiée
 */
function searchStudent($query)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour rechercher des étudiants correspondant à la requête spécifiée
        $sqlQuery = "SELECT * 
            FROM Utilisateur 
            WHERE type = 'Etudiant' 
            AND (prenomUtilisateur LIKE '%" . $query . "%' 
            OR nomUtilisateur LIKE '%" . $query . "%');
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/**
 * @fn function addUserTeam($idUser, $idTeam)
 * @param idUser l'id de l'utilisateur
 * @param idTeam l'id de l'équipe
 * @brief Ajoute un utilisateur à l'équipe spécifiée
 */
function addUserTeam($idUser, $idTeam)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour ajouter un utilisateur à l'équipe spécifiée
        $sqlQuery = "INSERT Composer(idEtudiant,idEquipe) 
            VALUES($idUser,$idTeam);
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function suppTeam($idTeam)
 * @param idTeam l'id de l'équipe
 * @brief Supprime l'équipe spécifiée, ainsi que tous ses membres
 */
function suppTeam($idTeam)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour supprimer tous les membres de l'équipe spécifiée
        $sqlQuery = "DELETE FROM Composer
            WHERE idEquipe = $idTeam;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour supprimer l'équipe spécifiée
        $sqlQuery = "DELETE FROM Equipe
            WHERE idEquipe = $idTeam;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function createTeam($nomEquipe, $idcapitaine, $idProjet)
 * @param nomEquipe le nom de l'équipe
 * @param idcapitaine l'id du capitaine de l'équipe
 * @param idProjet l'id du projet lié à l'équipe
 * @brief Crée une nouvelle équipe avec les informations spécifiées
 */
function createTeam($nomEquipe, $idcapitaine, $idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour créer une nouvelle équipe
        $sqlQuery = "INSERT into Equipe(nomEquipe, idCapitaine,idProjetData) 
            VALUES ($nomEquipe,$idcapitaine,$idProjet);
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getIdTeam($idUser, $idProjet)
 * @param idUser l'id de l'utilisateur
 * @param idProjet l'id du projet
 * @return l'id de l'équipe
 * @brief Récupère l'id de l'équipe à laquelle l'utilisateur est capitaine pour le projet spécifié
 */
function getIdTeam($idUser, $idProjet)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer l'id de l'équipe à laquelle l'utilisateur est capitaine
        $sqlQuery = "SELECT idEquipe 
            FROM Equipe 
            WHERE idCapitaine = $idUser 
            AND idProjetData = $idProjet;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getAllProjetUser($idUser)
 * @param idUser l'id de l'utilisateur
 * @return tous les projets de l'utilisateur
 * @brief Récupère tous les projets auxquels l'utilisateur participe
 */
function getAllProjetUser($idUser)
{
    try {
        // Se connecter à la base de données
        $conn = connect();
        // Requête SQL pour récupérer tous les projets auxquels l'utilisateur participe
        $sqlQuery = "SELECT * FROM Utilisateur 
            INNER JOIN Composer ON Composer.idEtudiant = Utilisateur.idUtilisateur 
            INNER JOIN Equipe ON Equipe.idEquipe = Composer.idEquipe 
            WHERE idUtilisateur = $idUser;
            ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/*
 * Permet de checker si un étudiant est inscrit à un des projet du challenge
 * @param mail : 
 */
function checkInscriptionEvenement($mail, $evenement)
{
    try {
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
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/*
 * Permet de checker si un étudiant est inscrit à un des projet du challenge
 * @param mail : 
 */
function checkInscriptionProjet($mail, $projet)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT COUNT(*) AS count
                        FROM Utilisateur AS u
                        INNER JOIN Composer AS c ON u.idUtilisateur = c.idEtudiant
                        INNER JOIN Equipe AS e ON c.idEquipe = e.idEquipe
                        WHERE u.email = :mail AND e.idProjetData = :projet";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':projet', $projet);
        $statement->execute();

        $result = $statement->fetch();
        $count = $result['count'];
        // Vérification de l'inscription
        if ($count > 0) {
            return true; // L'étudiant est inscrit au projet
        } else {
            return false; // L'étudiant n'est pas inscrit au projet
        }
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}


/*
 * Permet de checker si un gestionnaire supervise un des projet du challenge
 * @param mail : 
 */
function checkGestionnaireProjet($mail, $evenement)
{
    try {
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
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/*
 * Permet de checker si un gestionnaire supervise un des projet du challenge
 * @param mail : 
 */
function checkGestionnaireInterne($mail)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT COUNT(*) AS count
                        FROM Utilisateur AS
                        WHERE email = :mail AND LOWER(nomEntreprise) LIKE LOWER('IA Pau')";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->execute();

        $result = $statement->fetch();
        $count = $result['count'];
        // Vérification de l'inscription
        if ($count > 0) {
            return true; // Le gestionnaire est superviseur d'un projet
        } else {
            return false; // Le gestionnaire n'est  pas superviseur d'un projet
        }
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/*
 * Permet de checker si un gestionnaire supervise un des projet du challenge
 * @param mail : 
 */
function checkGestionnaireProjetData($mail, $idprojet)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT COUNT(*) AS count
                        FROM Utilisateur AS u
                        INNER JOIN Superviser AS s ON u.idUtilisateur = s.idGestionnaire
                        WHERE u.email = :mail AND s.idProjetData = :idprojet";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':idprojet', $idprojet);
        $statement->execute();

        $result = $statement->fetch();
        $count = $result['count'];
        // Vérification de l'inscription
        if ($count > 0) {
            return true; // Le gestionnaire est superviseur d'un projet
        } else {
            return false; // Le gestionnaire n'est  pas superviseur d'un projet
        }
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false; // En cas d'erreur, renvoyer false
    }
}

/**
 * @fn function getTeamQuestionnaire($idTeam, $idData, $num)
 * @param idTeam l'id de l'équipe
 * @param idData l'id des données de la bataille
 * @param num le numéro du questionnaire
 * @return les détails du questionnaire pour l'équipe spécifiée
 * @brief Récupère les détails du questionnaire pour une équipe spécifique, des données spécifiques et un numéro de questionnaire spécifique
 */
function getTeamQuestionnaire($idTeam, $idData, $num)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT * 
        FROM Questionnaire 
        INNER JOIN Question ON Question.idQuestionnaire = Questionnaire.idQuestionnaire 
        INNER JOIN Reponse ON Reponse.idQuestion = Question.idQuestion 
        WHERE idEquipe = $idTeam AND idDataBattle = $idData AND Questionnaire.numero = $num";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getMessageTeam($idTeam)
 * @param idTeam l'id de l'équipe
 * @return les messages pour l'équipe spécifiée
 * @brief Récupère les messages pour une équipe spécifique
 */
function getMessageTeam($idTeam)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT Messages.message, Messages.date_envoi, UtilisateurDes.nomUtilisateur as nomDestinataire, UtilisateurDes.prenomUtilisateur as prenomDestinataire, UtilisateurAut.nomUtilisateur as nomAuteur, UtilisateurAut.prenomUtilisateur as prenomAuteur
        FROM Composer
        INNER JOIN Messages ON Messages.id_destinataire = Composer.idEtudiant
        INNER JOIN Utilisateur as UtilisateurDes ON UtilisateurDes.idUtilisateur = Messages.id_destinataire
        INNER JOIN Utilisateur as UtilisateurAut ON UtilisateurAut.idUtilisateur = Messages.id_auteur
        WHERE Composer.idEquipe = $idTeam
        
        UNION
        
        SELECT Messages.message, Messages.date_envoi, UtilisateurDes.nomUtilisateur as nomDestinataire, UtilisateurDes.prenomUtilisateur as prenomDestinataire, UtilisateurAut.nomUtilisateur as nomAuteur, UtilisateurAut.prenomUtilisateur as prenomUtilisateur
        FROM Composer
        INNER JOIN Messages ON Messages.id_auteur = Composer.idEtudiant
        INNER JOIN Utilisateur as UtilisateurDes ON UtilisateurDes.idUtilisateur = Messages.id_destinataire
        INNER JOIN Utilisateur as UtilisateurAut ON UtilisateurAut.idUtilisateur = Messages.id_auteur
        WHERE Composer.idEquipe = $idTeam;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getLu($idUser, $idEnCours)
 * @param idUser l'id de l'utilisateur
 * @param idEnCours l'id en cours
 * @return les messages non lus entre l'utilisateur et l'id en cours
 * @brief Récupère les messages non lus entre l'utilisateur et l'id en cours
 */
function getLu($idUser, $idEnCours)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT *
        FROM Messages
        WHERE lu = 0
        AND id_destinataire = $idUser
        AND id_auteur = $idEnCours;";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getMembreTeam($idTeam)
 * @param idTeam l'id de l'équipe
 * @return les membres de l'équipe spécifiée
 * @brief Récupère les membres de l'équipe spécifiée
 */
function getMembreTeam($idTeam)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT idEtudiant 
        FROM Composer 
        WHERE idEquipe = $idTeam;
        ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function getNameGroup($idTeam)
 * @param idTeam l'id de l'équipe
 * @return le nom de l'équipe spécifiée
 * @brief Récupère le nom de l'équipe spécifiée
 */
function getNameGroup($idTeam)
{
    try {
        $conn = connect();
        $sqlQuery = "SELECT nomEquipe 
        FROM Equipe 
        WHERE idEquipe=$idTeam;
        ";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * @fn function sendMessage($idAut, $idDest, $message)
 * @param idAut l'id de l'auteur du message
 * @param idDest l'id du destinataire du message
 * @param message le contenu du message
 * @brief Envoie un message entre un auteur et un destinataire spécifiés
 */
function sendMessage($idAut, $idDest, $message)
{
    try {
        $conn = connect();
        $sqlQuery = "INSERT INTO Messages(message, date_envoi, id_auteur, id_destinataire)
        VALUES ('$message', NOW(), $idAut, $idDest)";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

    /*
 * Permet de mettre l'analyse du code du projetData
 * @param  : 
 */
function setAnalyseCode($idEquipe,$analyse)
{
    try {
        $conn = connect();
        $sqlQuery = "UPDATE Equipe SET analyseProjet=:analyse WHERE idEquipe=:idEquipe";
        $statement = $conn->prepare($sqlQuery);
        $statement->bindParam(':idEquipe', $idEquipe);
        $statement->bindParam(':analyse', $analyse);
        $statement->execute();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
/*
* Permet de checker si un gestionnaire supervise un des projet du challenge
* @param mail : 
*/
function getAnalyseCode($idProjetData)
{
   try {
       $conn = connect();
       $sqlQuery = "SELECT idEquipe,analyseProjet FROM Equipe WHERE idProjetData=:idProjetData";
       $statement = $conn->prepare($sqlQuery);
       $statement->bindParam(':idProjetData', $idProjetData);
       $statement->execute();
       $result = $statement->fetchAll();
            return $result;
   } catch (Exception $e) {
       die('Erreur : ' . $e->getMessage());
   }
}

?>
