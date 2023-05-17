DROP TABLE IF EXISTS sitedatachallenge;
CREATE DATABASE IF NOT EXISTS sitedatachallenge;
USE sitedatachallenge;


CREATE TABLE compte (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom varchar(100),
  password text,
  statut varchar(20)
);

