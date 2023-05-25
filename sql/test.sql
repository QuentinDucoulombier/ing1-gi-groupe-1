SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur
JOIN Utilisateur ON Utilisateur.idUtilisateur = Auteur.idUtilisateur
ORDER BY Messages.id_message ASC;


/*Ne donne pas les bons prenom trouver comment faire ou faire un cache misere */
SELECT Messages.id_message, Utilisateur.prenomUtilisateur, Utilisateur.nomUtilisateur, Messages.message, Messages.date_envoi, Messages.lu, Messages.id_auteur, Messages.id_destinataire     
FROM Messages
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_destinataire  
/*JOIN Destinataire ON Destinataire.id_destinataire = Messages.id_destinataire*/ 
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

/*
SELECT Messages.message, Messages.date_envoi
FROM Messages
JOIN Utilisateur ON Utilisateur.idUtilisateur = Messages.id_destinataire
JOIN Auteur ON Auteur.idUtilisateur = Messages.id_auteur;
WHERE Auteur.idUtilisateur = 1;
