-- CREATE DATABASE IF NOT EXISTS projetIaPau;
-- USE projetIaPau;

CREATE TABLE Evenement(
    idEvenement int NOT NULL AUTO_INCREMENT,
    nomChallenge varchar(64) NOT NULL,
    PRIMARY KEY (idDataChallenge)
);

CREATE TABLE Entreprise(
    idEntreprise int NOT NULL AUTO_INCREMENT,
    nomEntreprise varchar(30),
    PRIMARY KEY (idEntreprise)
);

CREATE TABLE ProjetData(
    idProjetData int NOT NULL AUTO_INCREMENT,
    idDataChallenge int NOT NULL,
    idEntreprise int NOT NULL,
    nomProjet varchar(512) NOT NULL,
    image varchar(1024),
    urlFichier varchar(1024),
    urlVideo varchar(1024),
    PRIMARY KEY (idProjetData),
    FOREIGN KEY (idDataChallenge) REFERENCES DataChallenge(idDataChallenge),
    FOREIGN KEY (idEntreprise) REFERENCES Entreprise(idEntreprise)
);

CREATE TABLE DataBattle(
    idDataBattle int NOT NULL AUTO_INCREMENT,
    idEntreprise int NOT NULL,
    nomDataBattle varchar(512) NOT NULL,
    PRIMARY KEY (idDataBattle),
    FOREIGN KEY (idEntreprise) REFERENCES Entreprise(idEntreprise)
);

CREATE TABLE Questionnaire(
    idQuestionnaire int NOT NULL AUTO_INCREMENT,
    idDataBattle int NOT NULL,
    PRIMARY KEY (idQuestionnaire),
    FOREIGN KEY (idDataBattle) REFERENCES DataBattle(idDataBattle)
);

CREATE TABLE Question(
    idQuestion int NOT NULL AUTO_INCREMENT,
    idQuestionnaire int NOT NULL,
    intituleQuestion varchar(1024) NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQuestionnaire) REFERENCES Questionnaire(idQuestionnaire)
);



CREATE TABLE Utilisateur(
    idUtilisateur int NOT NULL AUTO_INCREMENT,
    motDePasse varchar(255) NOT NULL,
    type varchar(30) NOT NULL,
    nomUtilisateur varchar(30) NOT NULL,
    prenomUtilisateur varchar(30) NOT NULL,
    idEntrepreprise int,
    numeroTel int NOT NULL,
    email varchar(64) NOT NULL,
    niveauEtude varchar(2),
    ecole varchar(30),
    ville varchar(30),
    PRIMARY KEY (idUtilisateur),
    FOREIGN KEY (idEntreprise) REFERENCES Entreprise(idEntrepreprise)
    UNIQUE (email)
);

CREATE TABLE Equipe(
    idEquipe int NOT NULL AUTO_INCREMENT,
    nomEquipe int NOT NULL,
    idCapitaine int NOT NULL,
    idProjetData int NOT NULL,
    PRIMARY KEY (idEquipe),
    FOREIGN KEY (idCapitaine) REFERENCES Utilisateur(idUtilisateur),
    FOREIGN KEY (idProjetData) REFERENCES ProjetData(idProjetData)
);

CREATE TABLE Composer(
    idEtudiant int NOT NULL,
    idEquipe int NOT NULL,
    PRIMARY KEY (idEquipe, idEtudiant),
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe),
    FOREIGN KEY (idEtudiant) REFERENCES Utilisateur(idUtilisateur),
);

CREATE TABLE Reponse(
    idReponse int NOT NULL AUTO_INCREMENT,
    idQuestion int NOT NULL,
    idEquipe int NOT NULL,
    reponse varchar(5000),
    note tinyint,
    PRIMARY KEY (idReponse),
    FOREIGN KEY (idQuestion) REFERENCES Questionnaire(idQuestionnaire),
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe)
);

CREATE TABLE Superviser(
    idProjetData int NOT NULL,
    idGestionnaire int NOT NULL,
    PRIMARY KEY (idProjetData, idGestionnaire),
    FOREIGN KEY (idProjetData) REFERENCES ProjetData(idProjetData),
    FOREIGN KEY (idGestionnaire) REFERENCES Utilisateur(idUtilisateur),
);