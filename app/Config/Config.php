<?php
// Configuration de base
define('BASE_URL', 'http://localhost/GESTION-CLIENTS');
define('ROOT_PATH', dirname(dirname(__DIR__)));

// Configuration de base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Modifiez selon vos paramètres
define('DB_PASS', ''); // Modifiez selon vos paramètres
define('DB_NAME', 'gestion_clients'); // Nom de votre base de données

// Configuration de sécurité
define('HASH_COST', 10); // Pour bcrypt
