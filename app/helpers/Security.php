<?php
class Security {
    /**
     * Hash un mot de passe
     * 
     * @param string $password Mot de passe en clair
     * @return string Mot de passe hashé
     */
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => HASH_COST]);
    }

    /**
     * Vérifie un mot de passe
     * 
     * @param string $password Mot de passe en clair
     * @param string $hash Hash du mot de passe stocké
     * @return bool
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Génère un token CSRF
     * 
     * @return string Token CSRF
     */
    public static function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Vérifie un token CSRF
     * 
     * @param string $token Token soumis
     * @return bool
     */
    public static function validateCsrfToken($token) {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Nettoie les données d'entrée
     * 
     * @param string $data Données à nettoyer
     * @return string Données nettoyées
     */
    public static function sanitize($data) {
        // Supprime les espaces inutiles
        $data = trim($data);
        // Supprime les antislashs
        $data = stripslashes($data);
        // Convertit les caractères spéciaux en entités HTML
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}
