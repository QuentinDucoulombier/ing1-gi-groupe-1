# projet

php -S localhost:8006

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

Ouvrez un navigateur et taper l'url :
http://localhost:8080

## Connexion sur le site web

*Accès Utilisateur*   
email : toto@tata.titi
Mot de passe : 1234

*Accès Gestionnaire*   
email : gestionnaire@test.fr
Mot de passe : 1234

*Accès Admin*   
email : admin@ia.pau
