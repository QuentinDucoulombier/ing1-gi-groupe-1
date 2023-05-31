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
/*
SELECT * 
FROM Composer 
INNER JOIN Equipe ON Equipe.idEquipe = Composer.idEquipe 
INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Equipe.idCapitaine
INNER JOIN ProjetData ON ProjetData.idProjetData = Equipe.idProjetData
where Utilisateur.idUtilisateur=2 AND Equipe.idProjetData=3;
*/
/*
select * 
from Utilisateur 
Inner Join Composer on Composer.idEtudiant = Utilisateur.idUtilisateur 
where idEtudiant = 1 and idEquipe =2;


DELETE FROM Composer
WHERE idEtudiant = 1 AND idEquipe = 2;


select * 
from Utilisateur 
Inner Join Composer on Composer.idEtudiant = Utilisateur.idUtilisateur 
where idEtudiant = 1 and idEquipe =2;

SELECT * FROM Utilisateur 
INNER JOIN Composer on Composer.idEtudiant = Utilisateur.idUtilisateur 
INNER JOIN Equipe on Equipe.idEquipe = Composer.idEquipe WHERE
idUtilisateur = 1;

SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_destinataire
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur

ORDER BY id_message ASC;



SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
LEFT JOIN Destinataire ON Destinataire.idUtilisateur = Messages.id_auteur
LEFT JOIN Utilisateur ON Utilisateur.idUtilisateur = Messages.id_auteur
where Messages.id_destinataire = 1
ORDER BY id_message ASC;
*/
/*
SELECT * 
FROM Messages
WHERE id_auteur = 1
OR id_destinataire = 1;
*/
/*
SELECT *
FROM Composer
INNER JOIN Messages ON Messages.id_destinataire = Composer.idEtudiant
INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Composer.idEtudiant
WHERE idEquipe = 2

UNION

SELECT *
FROM Composer
INNER JOIN Messages ON Messages.id_auteur = Composer.idEtudiant
INNER JOIN Utilisateur ON Utilisateur.idUtilisateur = Composer.idEtudiant
WHERE idEquipe = 2;
*/
/*
SELECT Messages.message, Messages.date_envoi, UtilisateurDes.nomUtilisateur as nomDestinataire, UtilisateurDes.prenomUtilisateur as prenomDestinataire, UtilisateurAut.nomUtilisateur as nomAuteur, UtilisateurAut.prenomUtilisateur as prenomAuteur
FROM Composer
INNER JOIN Messages ON Messages.id_destinataire = Composer.idEtudiant
INNER JOIN Utilisateur as UtilisateurDes ON UtilisateurDes.idUtilisateur = Messages.id_destinataire
INNER JOIN Utilisateur as UtilisateurAut ON UtilisateurAut.idUtilisateur = Messages.id_auteur
WHERE Composer.idEquipe = 1

UNION

SELECT Messages.message, Messages.date_envoi, UtilisateurDes.nomUtilisateur as nomDestinataire, UtilisateurDes.prenomUtilisateur as prenomDestinataire, UtilisateurAut.nomUtilisateur as nomAuteur, UtilisateurAut.prenomUtilisateur as prenomUtilisateur
FROM Composer
INNER JOIN Messages ON Messages.id_auteur = Composer.idEtudiant
INNER JOIN Utilisateur as UtilisateurDes ON UtilisateurDes.idUtilisateur = Messages.id_destinataire
INNER JOIN Utilisateur as UtilisateurAut ON UtilisateurAut.idUtilisateur = Messages.id_auteur
WHERE Composer.idEquipe = 1;
*/

SELECT *
FROM Messages
WHERE lu = 0
AND id_destinataire = 3 /*User*/
AND id_auteur = 4;  /*A affiché*/