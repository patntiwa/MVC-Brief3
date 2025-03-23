<?php
// register.php
session_start();
require_once 'config/database.php'; // Connexion à la base de données
require_once 'controllers/AuthController.php'; // Contrôleur Auth

// Instanciation des objets
$userModel = new User($db);
$authController = new AuthController($userModel);

// Traitement du formulaire d'inscription
$authController->register();
?>
