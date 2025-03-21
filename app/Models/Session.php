<?php
class Session {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Récupère l'historique des sessions d'un utilisateur
     */
    public function getByUserId($userId) {
        return $this->db->fetchAll(
            "SELECT * FROM sessions 
             WHERE user_id = ? 
             ORDER BY login_time DESC",
            [$userId]
        );
    }
    
    /**
     * Récupère toutes les sessions actives
     */
    public function getActiveSessions() {
        return $this->db->fetchAll(
            "SELECT s.*, u.username, u.email 
             FROM sessions s 
             JOIN users u ON s.user_id = u.id 
             WHERE s.logout_time IS NULL 
             ORDER BY s.login_time DESC"
        );
    }
}
