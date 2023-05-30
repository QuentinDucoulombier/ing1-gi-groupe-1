-- INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
--    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Farret","Aventin",NULL,"0110011001","farretaven@cy-tech.fr","L1","CY Tech","Pau");
-- INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
--    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Toto","tata",NULL,"0220020301","toto@tata.titi","M1","CY Tech","Pau");
-- INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
--    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Gestionnaire","Naire","Gestio","euralis","1111111111","gestionnaire@test.fr",NULL,NULL,"Pau");
-- INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
--    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Administrateur","Admin","istrateur",NULL,"0000000000","admin@ia.pau",NULL,NULL,"Pau");

-- INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement, descriptionEvent, imageEvent) VALUES ("Challenge Mai 2023","2023-05-17","2023-05-19","DataChallenge", "Les sujets abordés concernent le sport, l'énergie et le traitement de la langue. Des prix ont été décernés aux trois...", "/images/imgChallenge1.jpg");
-- INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement) VALUES ("Data Battle Juin 2023","2023-06-01","2023-07-01","DataBattle");
-- INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement) VALUES ("Challenge Avril 2023","2023-04-01","2022-05-01","DataChallenge");

-- INSERT INTO Questionnaire(idDataBattle,dateDebut,dateFin) VALUES (2,"2023-06-01","2023-06-08");
-- INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Quoi?");
-- INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Qui?");
-- INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Comment?");
-- INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Pourquoi?");
-- INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Quand?");


-- INSERT INTO ProjetData(idEvenement,nomProjet,description,image,urlFichier,urlVideo) VALUES (1,"projet1","description du projet",NULL,NULL,NULL);
-- INSERT INTO Equipe(nomEquipe,idCapitaine,idProjetData) VALUES("pau1",1,1);
-- INSERT INTO Composer(idEtudiant,idEquipe) VALUES (1,1);
-- INSERT INTO Composer(idEtudiant,idEquipe) VALUES (2,1);
-- INSERT INTO Composer(idEtudiant,idEquipe) VALUES (3,1);

-- INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (1,1,"oui",4);
-- INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (2,1,"oui",4);
-- INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (3,1,"oui",4);
-- INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (4,1,"oui",4);
-- INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (5,1,"oui",4);

-- INSERT INTO Superviser(idProjetData,idGestionnaire) VALUES (1,3);



INSERT INTO Evenement (nomEvenement, dateDebut, dateFin, descriptionEvent, imageEvent, typeEvenement)
VALUES
('Data Battle 1', '2023-01-01', '2023-01-31', 'Une compétition de données passionnante', '/images/imgChallenge1.jpg', 'dataBattle'),
('Data Battle 2', '2023-03-01', '2023-03-31', 'Une autre compétition de données captivante', '/images/imgChallenge1.jpg', 'dataBattle'),
('Data Challenge 1', '2023-02-01', '2023-02-03', 'Un défi de données stimulant', '/images/imgChallenge1.jpg', 'dataChallenge'),
('Data Challenge 2', '2023-02-10', '2023-02-12', 'Un autre défi de données intéressant', '/images/imgChallenge1.jpg', 'dataChallenge'),
('Data Challenge 3', '2023-05-10', '2023-06-12', 'Encore un autre défi de données intéressant', '/images/imgChallenge1.jpg', 'dataChallenge'),
('Data Challenge 4', '2023-10-10', '2023-11-12', 'Encore un de plus défi de données intéressant', '/images/imgChallenge1.jpg', 'dataChallenge');

INSERT INTO ProjetData (idEvenement, nomProjet, description, image, urlFichier, urlVideo, conseil, consigne)
VALUES 
    (1, 'Projet A', 'Description du Projet A', 'projet_a.jpg', 'https://urlfichier', 'https://www.youtube.com/watch?v=video_a', 'Voici des conseils pour le projet A', "Voici les consignes pour le projet A"),
    (3, 'Projet B', 'Description du Projet B', 'projet_b.jpg', 'https://urlfichier2', 'https://www.youtube.com/watch?v=video_b', 'Voici des conseils pour le projet B', "Voici les consignes pour le projet B"),
    (3, 'Projet C', 'Description du Projet C', 'projet_c.jpg', 'https://urlfichier3', 'https://www.youtube.com/watch?v=video_c', 'Voici des conseils pour le projet C', "Voici les consignes pour le projet C"),
    (4, 'Projet D', 'Description du Projet D', 'projet_d.jpg', 'https://urlfichier4', 'https://www.youtube.com/watch?v=video_d', 'Voici des conseils pour le projet D', "Voici les consignes pour le projet D");

INSERT INTO Questionnaire (idDataBattle, numero, dateDebut, dateFin)
VALUES 
    (1, 1, '2023-01-01', '2023-01-07'),
    (1, 2, '2023-01-08', '2023-01-15'),
    (1, 3, '2023-01-16', '2023-06-24'),
    (2, 1, '2023-03-01', '2023-03-07');

INSERT INTO Question (idQuestionnaire, intituleQuestion)
VALUES 
    (1, 'Quelle est votre expérience en analyse de données ?'),
    (1, 'Quels outils utilisez-vous pour manipuler des données ?'),
    (1, 'Quelles sont vos compétences en programmation ?'),
    (2, 'Quelles sont vos attentes pour cet événement ?'),
    (2, 'Avez-vous déjà participé à un défi de données auparavant ?'),
    (2, 'Quels types de projets vous intéressent le plus ?'),
    (3, 'Quelle est votre approche pour résoudre les problèmes de données complexes ?'),
    (4, 'Décrivez un projet de données sur lequel vous avez travaillé récemment.'),
    (4, "Quelles compétences spécifiques possédez-vous en matière d'exploration de données ?");

INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Toto","tata",NULL,"0220020301","toto@tata.titi","M1","CY Tech","Pau");
INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 

VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Farret","Aventin",NULL,"0110011001","farretaven@cy-tech.fr","L1","CY Tech","Pau");
INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel, niveauEtude)
VALUES 
    ('etudiant1@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Etudiant', 'Dupont', 'Jean', '1234567890', 'L2'),
    ('etudiant2@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Etudiant', 'Martin', 'Sophie', '0987654321', 'L3'),
    ('etudiant3@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Etudiant', 'Lefevre', 'Julien', '9876543210', 'D'),
    ('etudiant4@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Etudiant', 'Dubois', 'Emma', '0123456789','L1'),
    ('etudiant5@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Etudiant', 'Garcia', 'Léa', '4567890123','M2');


INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Gestionnaire","Naire","Gestio","euralis","1111111111","gestionnaire@test.fr",NULL,NULL,"Pau");
INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel)
VALUES 
    ('gestionnaire1@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Gestionnaire', 'Lefebvre', 'Luc', '1122334455'),
    ('gestionnaire2@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Gestionnaire', 'Dubois', 'Emma', '5544332211');

INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Administrateur","Admin","istrateur",NULL,"0000000000","admin@ia.pau",NULL,NULL,"Pau");
INSERT INTO Utilisateur (email, motDePasse, type, nomUtilisateur, prenomUtilisateur, numeroTel)
VALUES 
    ('admin1@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Administrateur', 'Moreau', 'Thomas', '9988776655');

INSERT INTO Equipe (nomEquipe, idCapitaine, idProjetData)
VALUES 
    ('Équipe A', 1, 1),
    ('Équipe B', 1, 3),
    ('Équipe C', 2, 3),
    ('Équipe D', 3, 1);

INSERT INTO Composer (idEtudiant, idEquipe)
VALUES 
    (1, 1),
    (1, 2),
    (2, 3),
    (3, 4),
    (4, 1),
    (5, 1),
    (6, 4);

INSERT INTO Reponse (idQuestion, idEquipe, reponse, note)
VALUES 
    (1, 1, 'Notre équipe possède une expérience solide en analyse de données.', 4),
    (2, 1, 'Nous utilisons principalement Python et SQL pour manipuler des données.', 3),
    (3, 1, 'Nous avons des compétences avancées en programmation en Python.', 4),
    (1, 4, "Nous attendons d'apprendre de nouvelles techniques d'analyse de données.", 4),
    (2, 4, 'Oui, nous avons déjà participé à plusieurs défis de données auparavant.', 1),
    (3, 4, "Nous sommes intéressés par les projets liés à l'apprentissage automatique.", 4);

INSERT INTO Superviser(idProjetData,idGestionnaire) VALUES (1,3);


/* Ajout auteur de base on modifiera en fonction de la connexion par la suite */
INSERT INTO Auteur (idUtilisateur)
VALUES (1);

/* Ajout destinataire de base */
INSERT INTO Destinataire (idUtilisateur)
VALUES (2);

INSERT INTO Superviser (idProjetData, idGestionnaire)
VALUES 
    (1, 8),
    (3, 8),
    (3, 7);

