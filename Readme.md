# 📌 Gestion des Clients - Application Web Sécurisée

## 📖 Description
Cette application web permet aux administrateurs de gérer les comptes clients et aux utilisateurs de consulter et modifier leurs informations personnelles. Elle repose sur une architecture **MVC personnalisée en PHP (POO) avec MySQL** et met un accent fort sur la **sécurité et la gestion des rôles**.

---

## 🎯 Objectifs du Projet
✅ Concevoir une application **PHP MVC** robuste et évolutive.  
✅ Implémenter une **authentification sécurisée** avec gestion des rôles.  
✅ Permettre aux administrateurs de **gérer les comptes clients** (CRUD, activation/désactivation).  
✅ Offrir aux clients un accès à leur **profil et historique de connexions**.  
✅ Assurer la **sécurité des données** (hashage des mots de passe, protection CSRF/XSS, sessions sécurisées).  

---

## 🏗️ Technologies Utilisées
- **Backend :** PHP (POO) avec une implémentation MVC personnalisée
- **Base de données :** MySQL
- **Frontend :** HTML5, CSS3 (avec Bootstrap ou Tailwind CSS)
- **Sécurité :** Hashage des mots de passe (bcrypt), Jetons CSRF, Sessions sécurisées
- **Versioning :** Git & GitHub

---

## ⚙️ Fonctionnalités Principales
### 🔹 **Authentification & Sécurité**
- Inscription et connexion avec **bcrypt** pour sécuriser les mots de passe.
- Gestion des sessions et restriction des accès selon **les rôles (Admin / Client)**.
- Protection contre **les attaques XSS, CSRF, et injections SQL**.

### 🔹 **Gestion des Utilisateurs**
#### **Administrateur**
- Accès à un **tableau de bord** listant tous les utilisateurs.
- **CRUD des comptes clients** : création, modification, suppression, activation/désactivation.
- Gestion des **rôles et permissions**.
- Consultation des **logs de connexion et d’activité**.

#### **Client**
- Inscription et connexion.
- Consultation et modification de **ses informations personnelles**.
- Accès à l’**historique de ses connexions**.

---

## 🏛️ Architecture MVC
```
project_root/
│── app/  # Contient toute la logique de l'application
│   ├── controllers/  # Gère les requêtes utilisateur et interagit avec les modèles
│   │   ├── AuthController.php  # Gère l'authentification (connexion, inscription, déconnexion)
│   │   ├── UserController.php  # Gère les utilisateurs (profil, mise à jour, gestion des rôles)
│   ├── models/  # Contient les classes représentant les données et la logique métier
│   │   ├── User.php  # Modèle utilisateur (CRUD, gestion des sessions)
│   │   ├── Role.php  # Modèle des rôles (gestion des autorisations)
│   │   ├── Session.php  # Modèle des sessions (historique des connexions)
│   ├── views/  # Contient les fichiers de vue qui affichent les données à l'utilisateur
│   │   ├── auth/  # Pages d'authentification
│   │   │   ├── login.php  # Page de connexion
│   │   │   ├── register.php  # Page d'inscription
│   │   ├── users/  # Pages liées aux utilisateurs
│   │   │   ├── profile.php  # Profil utilisateur
│   │   │   ├── dashboard.php  # Tableau de bord des utilisateurs
│   │   ├── layouts/  # Templates réutilisables pour les vues
│   │   │   ├── header.php  # En-tête commun aux pages
│   │   │   ├── footer.php  # Pied de page commun aux pages
│   │   │   ├── navbar.php  # Barre de navigation
│   ├── core/  # Contient les classes de base pour le fonctionnement du framework MVC
│   │   ├── Database.php  # Gère la connexion à la base de données
│   │   ├── Controller.php  # Classe parent des contrôleurs (chargement des vues, gestion des requêtes)
│   │   ├── Model.php  # Classe parent des modèles (fonctions de base CRUD)
│   │   ├── Router.php  # Gère le routage des URLs vers les contrôleurs correspondants
│   ├── config/  # Contient les fichiers de configuration
│   │   ├── config.php  # Paramètres de connexion à la base de données et autres configurations globales
│── public/  # Contient les fichiers accessibles publiquement (CSS, JS, images, etc.)
│   ├── css/  # Styles CSS
│   │   ├── styles.css (généré avec Tailwind)  # Fichier CSS principal généré avec Tailwind CSS
│   ├── js/  # Scripts JavaScript
│   ├── index.php  # Point d'entrée public de l'application (redirection vers le routeur)
│── .htaccess  # Configuration du serveur Apache pour la réécriture des URLs
│── index.php  # Fichier principal qui charge le routeur et initialise l'application

```

---

## 🛡️ Sécurité et Bonnes Pratiques
🔐 **Hashage des mots de passe** : bcrypt (`password_hash()`).  
🔐 **Requêtes préparées PDO** pour éviter les injections SQL.  
🔐 **Protection CSRF** via jetons pour chaque formulaire.  
🔐 **Restrictions d’accès** avec un système de rôles et sessions sécurisées.  
🔐 **Désactivation de l'affichage des erreurs** en production.  

---

## 🚀 Installation & Utilisation
### 📥 Prérequis
- Serveur local (**XAMPP, WAMP, MAMP**) ou un serveur distant avec PHP et MySQL.
- PHP **8.x+** recommandé.
- Composer (optionnel si ajout de bibliothèques externes).

### 📌 Étapes d’installation
1. **Cloner le projet**
```sh
 git clone https://github.com/username/nom-du-projet.git
```
2. **Créer la base de données** (MySQL)
```sql
 CREATE DATABASE gestion_clients;
```
3. **Importer le fichier SQL fourni** (`database.sql`) dans MySQL.
4. **Configurer la connexion à la base de données** dans `config/database.php`
```php
 define('DB_HOST', 'localhost');
 define('DB_NAME', 'gestion_clients');
 define('DB_USER', 'root');
 define('DB_PASS', '');
```
5. **Lancer le serveur local** (exemple avec PHP intégré)
```sh
 php -S localhost:8000 -t public/
```
6. **Accéder à l’application** via `http://localhost:8000`

---

## 🛠️ Développement & Contribution
📌 **Cloner le repo et créer une branche**
```sh
git checkout -b feature-nouvelle-fonctionnalite
```
📌 **Effectuer des modifications et valider**
```sh
git add .
git commit -m "Ajout d'une nouvelle fonctionnalité"
```
📌 **Envoyer sur GitHub**
```sh
git push origin feature-nouvelle-fonctionnalite
```
📌 **Créer une Pull Request** pour validation 🚀

---

## 📄 Modalités d'Évaluation
✅ **Code review** (qualité et structure du code).  
✅ **Démo et présentation** des fonctionnalités implémentées.  
✅ **Documentation technique** complète sur l’architecture du projet.  
✅ **Expérience utilisateur fluide et intuitive**.  

---

## 📞 Contact
📧 Email : contact@entreprise.com  
💻 GitHub : [Nom du Repo](https://github.com/username/nom-du-projet)  
🚀 Développé avec ❤️ par [Nom du Développeur]  

