<?php

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/routes.php';

// Inclure le routeur depuis le dossier config
if (file_exists('../config/routes.php')) {
    require_once '../config/routes.php';
} else {
    echo "Le fichier router.php n'existe pas.";
}

