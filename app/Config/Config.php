<?php
// /config/config.php

// Configuration de base
define('BASE_URL', 'http://localhost/gestion-utilisateurs');
define('SITE_NAME', 'Gestion Utilisateurs');

// Sessions
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Mettre à 1 en production avec HTTPS

// Options de debug
define('DEBUG', true);

// Fonction d'affichage des erreurs
function debug_log($message, $data = null)
{
    if (DEBUG) {
        echo '<pre>';
        echo '<strong>' . $message . '</strong><br>';
        if ($data) {
            print_r($data);
        }
        echo '</pre>';
    }
}