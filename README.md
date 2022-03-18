# Projet PHP 2021 - Generator

![Generator](images/logo.png)

__Bienvenue dans la documentation de Generator !__

Ce projet a été réalisé dans le cadre du cours de **Programmation Web Dynamique** en Bloc 1 en Informatique de gestion à l'INPRES.

Generator est un système de génération d'énoncés qui rend vos contenus attractifs à l'aide de champs aléatoires.

![Présentation](images/screenshot.png)

## Consignes du projet

__[:page_facing_up: Énoncé du projet](ressources/enonce.pdf)__

## Organisation du projet

* __[:books: documentation/](documentation/)__

  Ressources utiles à l'installation, à la configuration et à l'utilisation du projet.

* __[:framed_picture: images/](images/)__

  Images présentent dans cette documentation.

* __[:volcano: ressources/](ressources/)__

  Ressources utiles au développement du projet.

* __[:rocket: source/](source/)__

  Dossier principal contenant le code source du projet.

## Documentation

__[:page_facing_up: Version PDF de la documentation du projet](documentation/documentation.pdf)__

---

### Installation du projet

1. Importer la base de données « [/documentation/generator.sql](documentation/generator.sql) » dans phpMyAdmin.

2. Copier les fichiers du dossier « [source/](source/) » vers le dossier d'hébergement.

3. Modifier le fichier « [/content/includes/config.php](source/content/includes/config.php) » du dossier d'hébergement.

   ```php
   $config = array(
       /* ---------------------------------
       -------------- CONFIG --------------
       --------------------------------- */
       "sitelink" => "http://192.168.0.181/generator", # Lien du site (pas de / à la fin !)
       "uploads" => "content/uploads", # Dossier de mise en ligne des images

       /* ---------------------------------
       ------------- DATABASE -------------
       --------------------------------- */
       "dbname" => "generator", # Nom de la base de données
       "dbuser" => "root", # Nom d’utilisateur
       "dbpassword" => "root", # Mot de passe
       "dbhost" => "localhost" # Nom de l’hôte
   );
   ```

### Organisation du projet

![Organisation du projet](images/project-three.png)

### Schéma du projet

![Schéma du projet](images/map.jpg)
