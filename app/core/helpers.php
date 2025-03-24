<?php

// Une fonction de "debug" pour faciliter l'affichage des données (utile lors du développement)
function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

// Exemple d'une méthode pour rediriger
function redirect($url) {
    header("Location: $url");
    exit;
}

// Autres fonctions utilitaires globales peuvent être ajoutées ici
