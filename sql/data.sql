INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Farret","Aventin",NULL,"0110011001","farretaven@cy-tech.fr","L1","CY Tech","Pau");
INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Etudiant","Toto","tata",NULL,"0220020301","toto@tata.titi","M1","CY Tech","Pau");
INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Gestionnaire","Naire","Gestio","euralis","1111111111","gestionnaire@test.fr",NULL,NULL,"Pau");
INSERT INTO Utilisateur(motDePasse,type,nomUtilisateur,prenomUtilisateur,nomEntreprise,numeroTel,email,niveauEtude,ecole,ville) 
    VALUES ("7110eda4d09e062aa5e4a390b0a572ac0d2c0220","Admninistrateur","Admin","istrateur",NULL,"0000000000","admin@ia.pau",NULL,NULL,"Pau");

INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement) VALUES ("Challenge Mai 2023","2023-05-17","2023-05-19","DataChallenge");
INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement) VALUES ("Data Battle Juin 2023","2023-06-01","2023-07-01","DataBattle");
INSERT INTO Evenement(nomEvenement,dateDebut,dateFin,typeEvenement) VALUES ("Challenge Avril 2023","2023-04-01","2022-05-01","DataChallenge");

INSERT INTO Questionnaire(idDataBattle,dateDebut,dateFin) VALUES (2,"2023-06-01","2023-06-08");
INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Quoi?");
INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Qui?");
INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Comment?");
INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Pourquoi?");
INSERT INTO Question(idQuestionnaire,intituleQuestion) VALUES (1,"Quand?");


INSERT INTO ProjetData(idEvenement,nomProjet,description,image,urlFichier,urlVideo) VALUES (1,"projet1","description du projet",NULL,NULL,NULL);
INSERT INTO Equipe(nomEquipe,idCapitaine,idProjetData) VALUES("pau1",1,1);
INSERT INTO Composer(idEtudiant,idEquipe) VALUES (1,1);
INSERT INTO Composer(idEtudiant,idEquipe) VALUES (2,1);
INSERT INTO Composer(idEtudiant,idEquipe) VALUES (3,1);

INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (1,1,"oui",4);
INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (2,1,"oui",4);
INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (3,1,"oui",4);
INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (4,1,"oui",4);
INSERT INTO Reponse(idQuestion,idEquipe,reponse,note) VALUES (5,1,"oui",4);

INSERT INTO Superviser(idProjetData,idGestionnaire) VALUES (1,3);