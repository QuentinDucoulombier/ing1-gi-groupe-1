<?php

    require_once('bddData.php');


    /*
    * Permet de se connecter à la base de données
    * @return true En cas de succès
    */
    function connect() {

        $connexion = null;
        global $username; // récupère le nom d'utilisateur
        global $password; // récupère le password
        global $bddname;

        try
        {
            // On se connecte à MySQL    
            $connexion = new PDO(
                'mysql:host=localhost;dbname='.$bddname.';charset=utf8',
                $username,
                $password
            );
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
        }
        return $connexion;
    }

    /*
    * Permet de faire une requête SQL générique
    * @param req : requete SQL
    * @param connexion : variable de connexion
    * @return tableau de valeurs
    */
    function request($connexion, $req){
        $sqlQuery = $req;
        $statement = $connexion->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    /*
    * Permet de vérifier si l'utilisateur est présent dans la base de données (au moment de la connexion)
    * @param mail : mail de l'utilisateur
    * @param pass : Mot de passe
    * @return true si le nom d'utilisateur est associé au mdp
    */
    function isUser($conn, $mail, $pass){
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
    function addEtudiant($conn, $mail, $password, $nom, $prenom, $tel, $niv, $ecole, $ville){
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



    
    function addGestionnaire($conn, $mail, $password, $nom, $prenom, $tel, $niv, $ecole, $ville){
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




    // Fonction de déconnexion
    function disconnect($conn) {
        $conn->close();
    }

?>