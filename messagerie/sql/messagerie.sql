DROP DATABASE IF EXISTS messagerie;
CREATE DATABASE messagerie;
USE messagerie;


/*On pourra rajouter:
supprime TINYINT(1)
et le statut de destinataire et auteur

/*Table messages*/
CREATE TABLE messages (
  id_message INT AUTO_INCREMENT PRIMARY KEY,
  id_auteur INT,
  id_destination INT,
  message TEXT,
  date_envoi DATETIME,
  lu TINYINT(1)
);

/* Table auteurs*/
CREATE TABLE auteurs (
  id_auteur INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);

/*Table destinations*/
CREATE TABLE destinations (
  id_destination INT AUTO_INCREMENT PRIMARY KEY,
  prenom VARCHAR(255),
  nom VARCHAR(255),
  email VARCHAR(255)
);

