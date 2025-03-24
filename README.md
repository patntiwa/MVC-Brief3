# Application PHP MVC de Gestion d'Utilisateurs

## Vue d'ensemble
Cette application est une plateforme web basée sur PHP construite avec une architecture MVC (Modèle-Vue-Contrôleur) pour l'authentification des utilisateurs et le contrôle d'accès basé sur les rôles. Elle fournit une approche structurée pour gérer différents types d'utilisateurs (administrateurs et clients) avec des tableaux de bord séparés et des flux d'authentification.

## Fonctionnalités
- Système d'authentification utilisateur (connexion, inscription, déconnexion)
- Contrôle d'accès basé sur les rôles (rôles Administrateur et Client)
- Hachage sécurisé des mots de passe avec les fonctions intégrées de PHP
- Vues de tableau de bord adaptées aux rôles des utilisateurs
- Validation des formulaires pour les entrées utilisateur
- Gestion des sessions
- Routage d'URL propre avec configuration .htaccess

## Structure du Projet
```
racine-projet/
├── app/
│   ├── controllers/
│   │   ├── AuthController.php (Connexion, Inscription, Déconnexion)
│   │   ├── ClientController.php (Fonctionnalités spécifiques aux clients)
│   │   ├── DashboardController.php (Rendu du tableau de bord)
│   │   └── UserController.php
│   ├── core/
│   │   └── helpers.php (Fonctions utilitaires)
│   ├── models/
│   │   ├── Role.php (Gestion des rôles)
│   │   ├── Session.php (Suivi des sessions)
│   │   └── User.php (Gestion des utilisateurs)
│   └── views/
│       ├── admin/
│       │   ├── client.php
│       │   └── dashboard.php
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── client/
│       │   ├── dashboard.php
│       │   └── profile.php
│       ├── components/
│       │   ├── footer.php
│       │   ├── header.php
│       │   └── sidebar.php
│       └── layouts/
│           └── main.php
├── config/
│   ├── config.php (Constantes de l'application)
│   ├── database.php (Configuration de la connexion à la base de données)
│   └── routes.php (Configuration du routage des URL)
├── public/
│   ├── css/
│   ├── images/
│   ├── js/
│   └── index.php (Point d'entrée de l'application)
└── .htaccess (Règles de réécriture d'URL)
```

## Configuration de la Base de Données
L'application utilise MySQL avec la configuration suivante :
- Nom de la Base de Données : `gestion_clients`
- Tables de la Base de Données :
  - `users` : Stocke les informations utilisateur (id, username, email, password, role_id)
  - `roles` : Stocke les rôles d'utilisateur disponibles
  - `sessions` : Suit les sessions de connexion des utilisateurs

## Installation
1. Clonez le dépôt dans votre environnement local
2. Configurez un serveur web local (comme XAMPP, WAMP ou MAMP) pointant vers le répertoire du projet
3. Importez la structure de la base de données (script SQL non inclus dans les fichiers - vous devrez le créer)
4. Configurez votre connexion à la base de données dans `config/database.php`
5. Accédez à l'application dans votre navigateur web

## Structure des URL
L'application utilise un système de routage simple basé sur des paramètres d'URL :
- Connexion : `?route=login`
- Inscription : `?route=register`
- Tableau de bord : `?route=dashboard`
- Déconnexion : `?route=logout`

## Flux d'Authentification
1. Les utilisateurs peuvent s'inscrire avec un nom d'utilisateur, un email, un mot de passe et une sélection de rôle
2. Après une connexion réussie, les utilisateurs sont redirigés vers leur tableau de bord approprié en fonction de leur rôle
3. Les variables de session suivent l'état d'authentification de l'utilisateur
4. La déconnexion détruit la session et redirige vers la page de connexion

## Système de Rôles
L'application prend actuellement en charge deux rôles :
1. Administrateur (role_id = 1) : Accès au tableau de bord administratif
2. Client (role_id = 2) : Accès aux vues spécifiques aux clients

## Fonctionnalités de Sécurité
- Hachage des mots de passe à l'aide de `password_hash()` et `password_verify()` de PHP
- Validation de formulaire pour toutes les entrées utilisateur
- Vérification d'authentification basée sur les sessions
- Contrôle d'accès basé sur les rôles pour protéger les routes

## Frontend
- L'application utilise Tailwind CSS (via CDN) pour le style
- Approche de conception responsive pour la compatibilité entre les appareils
- Messages d'erreur et de succès pour les interactions avec les formulaires

## Possibilités de Développement Futur
- Implémentation de la fonctionnalité de réinitialisation de mot de passe
- Ajout de capacités d'édition de profil utilisateur
- Amélioration des fonctionnalités de gestion administrateur
- Implémentation d'un système de journal d'activité
- Création d'un système de gestion d'erreurs plus robuste

## Remarques
- Certaines vues et composants sont encore incomplets (comme le tableau de bord client, l'en-tête, le pied de page et la barre latérale)
- L'implémentation actuelle se concentre sur l'authentification de base et l'accès basé sur les rôles