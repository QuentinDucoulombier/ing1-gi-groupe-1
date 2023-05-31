# projet

## Connexion à la base de données

*Se placer dans le dossier du projet*

Vous devez disposer d'un utilisateur root sans mot de passe ou vous pouvez modifier les identifiants de connexion dans le fichier action/database_login.php

- Se connecter à MySQL 
``` bash
mysql -u user -p
```
- Charger les fichiers

```bash
    source sql/table.sql
    source sql/data.sql
```

## Accéder au site web

Placez-vous dans le dossier du projet et tapez la commande :

```bash
php -S localhost:8080
```

Ouvrez un navigateur et accédez à l'url :
http://localhost:8080

## Connexion sur le site web

*Accès Utilisateur*   
email : toto@tata.titi  
Mot de passe : 1234  
- idUtilisateur = 1  
- Chef et membre des équipes d'id 1 (Equipe A) et 2 (Equipe B)
- L'équipe A est inscrite au projetData 1 (Projet A) qui appartient à la data battle 1 (id1)
- L'equipe B est inscrite au ProjetData 3 (Projet C) qui appartient au data challenge 1 (id3)


*Accès Gestionnaire*   
email : gestionnaire@test.fr
Mot de passe : 1234
- idUtilisateur = 8
- Supervise le projetData 1 (Projet A) qui appartient à la data battle 1 (id1)
- Supervise le projetData 3 (Projet C) qui appartient au data challenge 1 (id3)

*Accès Admin*   
email : admin@ia.pau
Mot de passe : 1234
- L'administrateur a accès à tout
