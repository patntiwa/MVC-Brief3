<?php

require_once '../config/routes.php';

// Inclure le routeur depuis le dossier config
if (file_exists('../config/routes.php')) {
    require_once '../config/routes.php';
} else {
    echo "Le fichier router.php n'existe pas.";
}

