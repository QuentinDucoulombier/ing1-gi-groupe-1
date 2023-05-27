/*
SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur
ORDER BY Messages.id_message ASC;


SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire     
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_destinataire  
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur     
ORDER BY Messages.id_message ASC;




SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur

UNION

SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_destinataire
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur

ORDER BY id_message ASC;


SELECT Messages.message, Messages.date_envoi
FROM Messages
JOIN Utilisateur ON Utilisateur.idUtilisateur = Messages.id_destinataire
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur;
WHERE Auteur.idUtilisateur = 1;


SELECT Messages.message, Messages.date_envoi, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Destinataire ON Destinataire.idUtilisateur = Messages.id_auteur
WHERE Messages.id_destinataire = 4; 


SELECT Messages.message, Messages.date_envoi, Messages.id_auteur, Messages.id_destinataire, Messages.lu
FROM Messages
WHERE Messages.id_destinataire = 4 AND Messages.id_auteur = 3;


UPDATE Messages
SET Messages.lu = 1
WHERE Messages.id_destinataire = 4 AND Messages.id_auteur = 3;

SELECT Messages.message, Messages.date_envoi, Messages.id_auteur, Messages.id_destinataire, Messages.lu
FROM Messages
WHERE Messages.id_destinataire = 4 AND Messages.id_auteur = 3;
*/

/*
select * from Equipe 
INNER JOIN Composer on Composer.idEquipe = Equipe.idEquipe 
Inner join Utilisateur on Utilisateur.idUtilisateur = Composer.idEtudiant;
*/
/*
UPDATE Equipe
INNER JOIN Composer on Composer.idEquipe = Equipe.idEquipe 
SET idCapitaine = 2
WHERE idProjetData = 
*/

SELECT * 
FROM Composer 
INNER JOIN Equipe ON Equipe.idEquipe = Composer.idEquipe 
INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Composer.idEtudiant
where Composer.idEquipe=4;
