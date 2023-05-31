DROP DATABASE IF EXISTS projetIaPau;
CREATE DATABASE IF NOT EXISTS projetIaPau;
USE projetIaPau;

CREATE TABLE Evenement(
    idEvenement int AUTO_INCREMENT,
    nomEvenement varchar(64) NOT NULL,
    dateDebut date,
    dateFin date,
    descriptionEvent varchar(264),
    imageEvent varchar(1024),
    typeEvenement varchar(30),
    PRIMARY KEY (idEvenement),
    CONSTRAINT check_typeEvenement CHECK (typeEvenement IN ('dataBattle', 'dataChallenge'))
);

-- CREATE TABLE Entreprise(
--     idEntreprise int NOT NULL AUTO_INCREMENT,
--    nomEntreprise varchar(30),
--    PRIMARY KEY (idEntreprise)
-- );

CREATE TABLE ProjetData(
    idProjetData int NOT NULL AUTO_INCREMENT,
    idEvenement int NOT NULL,
 --   idEntreprise int NOT NULL,
    nomProjet varchar(512) NOT NULL,
    description varchar(1024),
    image varchar(1024),
    urlFichier varchar(1024),
    urlVideo varchar(1024),
    conseil varchar(1024),
    consigne varchar(1024),
    PRIMARY KEY (idProjetData),
    FOREIGN KEY (idEvenement) REFERENCES Evenement(idEvenement) ON DELETE CASCADE
--    FOREIGN KEY (idEntreprise) REFERENCES Entreprise(idEntreprise)
);

CREATE TABLE Questionnaire(
    idQuestionnaire int NOT NULL AUTO_INCREMENT,
    idDataBattle int NOT NULL,
    numero int,
    dateDebut date,
    dateFin date,
    PRIMARY KEY (idQuestionnaire),
    FOREIGN KEY (idDataBattle) REFERENCES Evenement(idEvenement) ON DELETE CASCADE
);

CREATE TABLE Question(
    idQuestion int NOT NULL AUTO_INCREMENT,
    idQuestionnaire int NOT NULL,
    intituleQuestion varchar(1024) NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQuestionnaire) REFERENCES Questionnaire(idQuestionnaire) ON DELETE CASCADE
);

CREATE TABLE Utilisateur(
    idUtilisateur int NOT NULL AUTO_INCREMENT,
    email varchar(64) NOT NULL,
    motDePasse varchar(255) NOT NULL,
    type varchar(30) NOT NULL,
    nomUtilisateur varchar(30) NOT NULL,
    prenomUtilisateur varchar(30) NOT NULL,
    numeroTel char(10) NOT NULL,
    niveauEtude varchar(2),
    ecole varchar(30),
    ville varchar(30),
    nomEntreprise varchar(30),
    dateDebutUtilisateur date,
    dateFinUtilisateur date,
    PRIMARY KEY (idUtilisateur),
--    FOREIGN KEY (nomEntreprise) REFERENCES Entreprise(nomEntreprise),
    UNIQUE (email),
    CONSTRAINT check_numerotel CHECK (numeroTel REGEXP '^[0-9]{10}$'),
    CONSTRAINT check_niveauEtude CHECK (niveauEtude IN ('','L1', 'L2', 'L3', 'M1', 'M2', 'D')),
    CONSTRAINT check_type CHECK (type IN ('Etudiant', 'Gestionnaire', 'Administrateur'))
);

CREATE TABLE Equipe(
    idEquipe int NOT NULL AUTO_INCREMENT,
    nomEquipe varchar(255) NOT NULL,
    idCapitaine int NOT NULL,
    idProjetData int NOT NULL,
        analyseProjet varchar(1024),
    PRIMARY KEY (idEquipe),
    FOREIGN KEY (idCapitaine) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE,
    FOREIGN KEY (idProjetData) REFERENCES ProjetData(idProjetData) ON DELETE CASCADE
);

CREATE TABLE Composer(
    idEtudiant int NOT NULL,
    idEquipe int NOT NULL,
    PRIMARY KEY (idEquipe, idEtudiant),
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe) ON DELETE CASCADE,
    FOREIGN KEY (idEtudiant) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Reponse(
    idReponse int NOT NULL AUTO_INCREMENT,
    idQuestion int NOT NULL,
    idEquipe int NOT NULL,
    reponse varchar(4096),
    note tinyint,
    PRIMARY KEY (idReponse),
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE,
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe) ON DELETE CASCADE,
    CONSTRAINT check_note CHECK (note>=0 AND note<5)
);

CREATE TABLE Superviser(
    idProjetData int NOT NULL,
    idGestionnaire int NOT NULL,
    PRIMARY KEY (idProjetData, idGestionnaire),
    FOREIGN KEY (idProjetData) REFERENCES ProjetData(idProjetData) ON DELETE CASCADE,

    FOREIGN KEY (idGestionnaire) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE

);


/* Table auteurs */
CREATE TABLE Auteur (
  id_auteur INT AUTO_INCREMENT PRIMARY KEY,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur)
);

/* Table destinataires */
CREATE TABLE Destinataire (
  id_destinataire INT AUTO_INCREMENT PRIMARY KEY,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur)
);

/* Table messages */
CREATE TABLE Messages (
  id_message INT AUTO_INCREMENT PRIMARY KEY,
  id_auteur INT,
  id_destinataire INT,
  message TEXT,
  date_envoi DATETIME,
  lu TINYINT(1) DEFAULT 0

);
