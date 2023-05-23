DROP DATABASE IF EXISTS messagerie;
CREATE DATABASE messagerie;
USE messagerie;

/* Table users */
CREATE TABLE User (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);

/* Ajout d'utilisateurs */
INSERT INTO User (prenom, nom, email)
VALUES ('prenomA', 'nomA', 'emailA'), ('prenomD', 'nomD', 'emailD'), ('monsieur', 'test', 'test@gmail.com');


/* Table auteurs */
CREATE TABLE Auteur (
  id_auteur INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT,
  FOREIGN KEY (id_user) REFERENCES User(id_user)
);

/* Table destinataires */
CREATE TABLE Destinataire (
  id_destinataire INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT,
  FOREIGN KEY (id_user) REFERENCES User(id_user)
);

/* Table messages */
CREATE TABLE Messages (
  id_message INT AUTO_INCREMENT PRIMARY KEY,
  id_auteur INT DEFAULT 1,
  id_destinataire INT DEFAULT 1,
  message TEXT,
  date_envoi DATETIME,
  lu TINYINT(1),
  FOREIGN KEY (id_auteur) REFERENCES Auteur(id_auteur),
  FOREIGN KEY (id_destinataire) REFERENCES Destinataire(id_destinataire)
);

/* Ajout auteur de base on modifiera en fonction de la suite */
INSERT INTO Auteur (id_user)
VALUES (1);

/* Ajout destinataire de base */
INSERT INTO Destinataire (id_user)
VALUES (2);
