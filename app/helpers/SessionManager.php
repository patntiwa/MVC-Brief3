<?php
class SessionManager {
    /**
     * Démarre une session sécurisée
     */
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            // Configurer les cookies de session sécurisés
            ini_set('session.use_only_cookies', 1);
            $cookieParams = session_get_cookie_params();
            session_set_cookie_params(
                $cookieParams["lifetime"],
                $cookieParams["path"],
                $cookieParams["domain"],
                true,   // Secure cookie (HTTPS)
                true    // HttpOnly flag
            );
            session_name('secure_session');
            session_start();
            
            // Régénérer l'ID de session pour prévenir la fixation de session
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id();
                $_SESSION['initiated'] = true;
            }
        }
    }

    /**
     * Enregistre une session utilisateur
     */
    public static function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role_id'] = $user['role_id'];
        
        // Enregistrer la connexion dans la table sessions
        $db = Database::getInstance();
        $db->insert("INSERT INTO sessions (user_id, login_time) VALUES (?, NOW())",
            [$user['id']]);
        
        // Stocker l'ID de session pour la déconnexion
        $_SESSION['session_db_id'] = $db->connection->lastInsertId();
    }

    /**
     * Termine une session utilisateur
     */
    public static function destroyUserSession() {
        // Mettre à jour la table sessions avec un temps de déconnexion
        if (isset($_SESSION['user_id']) && isset($_SESSION['session_db_id'])) {
            $db = Database::getInstance();
            $db->query("UPDATE sessions SET logout_time = NOW() 
                     WHERE id = ? AND user_id = ?",
                    [$_SESSION['session_db_id'], $_SESSION['user_id']]);
        }
        
        // Détruire toutes les données de session
        $_SESSION = [];
        
        // Détruire le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Détruire la session
        session_destroy();
    }
}
