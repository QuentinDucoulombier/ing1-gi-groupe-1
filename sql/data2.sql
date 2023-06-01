INSERT INTO Evenement (nomEvenement, dateDebut, dateFin, descriptionEvent, imageEvent, typeEvenement)
VALUES
('Data battle Nouvelle Aquitaine 2022', '2023-01-01', '2023-01-31', 'Une compétition de données passionnante', '/images/imgChallenge5.jpg', 'dataBattle'),
('Data Battle 2', '2023-03-01', '2023-03-31', 'Une autre compétition de données captivante', '/images/imgChallenge6 .jpg', 'dataBattle'),
('Data challenge janvier 2022', '2023-01-15', '2023-01-17', 'Les sujets abordés concernent la détection d`objets, le traitement de la langue et la classification de documents. Des...', '/images/imgChallenge1.jpg', 'dataChallenge'),
('data challenge festival', '2023-12-05', '2023-12-06', 'Un autre défi de données intéressant', '/images/imgChallenge2.jpg', 'dataChallenge'),
('Data Challenge 3', '2023-05-10', '2023-06-12', "Les sujets abordés concernent le sport, l'énergie et le traitement de la langue. Des prix ont été décernés aux trois...", '/images/imgChallenge3.jpg', 'dataChallenge'),
('Data Challenge 4', '2023-10-10', '2023-11-12', 'Encore un de plus défi de données intéressant', '/images/imgChallenge4.jpg', 'dataChallenge');


INSERT INTO ProjetData (idEvenement, nomProjet, description, image, urlFichier, urlVideo, conseil, consigne)
VALUES 
    (1, 'Projet A', 'L’entreprise TATAMI développe une plateforme appelée VivaJob qui permet de matcher des entreprises qui recherchent des compétences et des personnes à la recherche d’un emploi, ceci quel soit le type de contrat (CDI, CDD, intérim, stage).
Le projet consiste à rechercher la meilleure technologie de correspondance entre des offres d’emplois et des contenus de CVs.
Un jeu de données a été constitué, à partir d’une source de données réelles issues d’un partenaire de l’entreprise spécialiste du recrutement et de l’intérim : ces données ont été anonymisées et structurées (extraction data intéressante) avec l’aide des experts d’IA PAU.
L’objectif est d’utiliser les technologies de l’intelligence artificielle afin de trouver des critères supplémentaires de correspondances offres – candidatures, d’affiner la lecture des détails invisibles des candidats et de corriger les biais éventuels inhérents au recrutement.', '/images/imgChallenge5.jpg', 'https://urlfichier1', 'https://www.youtube.com/watch?v=XQUb9kyhjdM&t=336s', 'Voici des conseils pour le projet A', "Voici les consignes pour le projet A"),
    (3, 'API Conseil : classification des brevets', 
    'Problématique et objectifs : construire un algorithme capable de déterminer 2-3 classifications les plus probables à partir de la partie revendication (seulement 500-1000 mots) d’une demande de brevet. Un point crucial et original sera de construire un modèle interprétable dans le sens où ses décisions pourront être facilement explicitées par un lien direct avec les données.',
        '/images/projet_a.jpg', 
        'https://urlfichier1', 
        'https://www.youtube.com/watch?v=iSY-lrouMfc&t=2398s', 
        'Voici des conseils pour le projet A', 
        "Voici les consignes pour le projet A"),
    (3, 'Cap Gemini : recherche de pages contenant des zones à intérêt dans un document PDF',
        'Problématique et objectifs : construire une solution qui recherche dans des documents pdf de plusieurs centaines de pages, les pages contenant les ZOI (Zone Of Interest) concernant les caractéristiques de pression des fluides (une fois trouvées, les données seront extraites manuellement).',
        '/images/projet_a.jpg',
        'https://urlfichier1',
        'https://www.youtube.com/watch?v=iSY-lrouMfc&t=1262s',
        'Voici des conseils pour le projet A',
        "Voici les consignes pour le projet A"),
    (3, 'Surf Rider : détection et classification de déchets dans des images et vidéos', 'Problématique et objectifs : construire un algorithme ou retravailler l’existant pour lui permettre de détecter et classer dans 10 catégories les déchets détectés dans des images ou vidéos. Comparer les performances de l’ancien et du nouveau modèle. L’algorithme doit fonctionner sur mobile : il doit donc rester léger tout en étant performant.', '/images/projet_a.jpg', 'https://urlfichier1', 'https://www.youtube.com/watch?v=iSY-lrouMfc&t=1704s', 'Voici des conseils pour le projet A', "Voici les consignes pour le projet A"),
    (4, 'Elan Béarnais Pau Lacq Orthez (Pau) : team performance prediction with machine learning', 'Problématique et objectifs : construire un algorithme capable de suggérer à l’utilisateur à tout moment durant un match, une ou plusieurs solutions de coaching en fonction de l’évolution du score, du temps restant à jouer, et des joueurs présents sur le terrain.
Descriptif du jeu de données fourni : un historique de plus de 28 000 évènements observés durant plusieurs matchs.', '/images/projet_b.jpg', 'https://urlfichier2', 'https://www.youtube.com/watch?v=ndy3ZOdnz0I&t=1165', 'Voici des conseils pour le projet B', "Voici les consignes pour le projet B"),
    (4, 'Téréga (Pau) : prévisions des demandes clients', 'Problématique et objectifs : construire un algorithme capable de prévoir les demandes de capacités de transport de gaz des clients dans les points de stockage et les points d’interfaces entre deux réseaux.
Descriptif du jeu de données fourni : un historique des demandes réelles des clients depuis 2016 et un historique des variables pouvant influencer ces demandes depuis 2016.', '/images/projet_c.jpg', 'https://urlfichier3', 'https://www.youtube.com/watch?v=ndy3ZOdnz0I&t=1844', 'Voici des conseils pour le projet C', "Voici les consignes pour le projet C"),
    (5, 'Projet D', 'Description du Projet D', '/images/projet_d.jpg', 'https://urlfichier4', 'https://www.youtube.com/watch?v=ndy3ZOdnz0I&t=491', 'Voici des conseils pour le projet D', "Voici les consignes pour le projet D");

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

