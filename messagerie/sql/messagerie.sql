DROP DATABASE IF EXISTS messagerie;
CREATE DATABASE messagerie;
USE messagerie;


/*On pourra rajouter:
supprime TINYINT(1)
et le statut de destinataire et auteur*/

/*Table user */
CREATE TABLE User (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);

/* Table auteurs*/
CREATE TABLE Auteur (
  id_auteur INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);

/*Table destinations*/
CREATE TABLE Destinateur (
  id_destinateur INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);


/*Table messages*/
CREATE TABLE Messages (
  id_message INT AUTO_INCREMENT PRIMARY KEY,
  id_auteur INT,
  id_destinateur INT,
  message TEXT,
  date_envoi DATETIME,
  lu TINYINT(1),
  FOREIGN KEY (id_auteur) REFERENCES Auteur(id_auteur),
  FOREIGN KEY (id_destinateur) REFERENCES Destinateur(id_destinateur)
);

