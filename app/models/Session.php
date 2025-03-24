<?php
class Session {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Enregistrer une nouvelle session de connexion
    public function logSession($userId) {
        $this->db->query("INSERT INTO sessions (user_id, ip_address, user_agent) 
                          VALUES (:user_id, :ip, :agent)");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':ip', $_SERVER['REMOTE_ADDR']);
        $this->db->bind(':agent', $_SERVER['HTTP_USER_AGENT']);
        return $this->db->execute();
    }
    
    // Enregistrer l'heure de déconnexion
    public function logLogout($userId) {
        $this->db->query("UPDATE sessions 
                          SET logout_time = NOW() 
                          WHERE user_id = :user_id 
                          AND logout_time IS NULL 
                          ORDER BY login_time DESC 
                          LIMIT 1");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
    
    // Obtenir les sessions d'un utilisateur
    public function getUserSessions($userId) {
        $this->db->query("SELECT * FROM sessions 
                          WHERE user_id = :user_id 
                          ORDER BY login_time DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    // Obtenir les dernières sessions (pour dashboard admin)
    public function getRecentSessions($limit = 10) {
        $this->db->query("SELECT s.*, u.username, u.first_name, u.last_name
                          FROM sessions s
                          JOIN users u ON s.user_id = u.id
                          ORDER BY s.login_time DESC
                          LIMIT :limit");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    
    // Obtenir les statistiques (pour dashboard admin)
    public function getSessionStats() {
        $this->db->query("SELECT 
                            COUNT(*) as total_sessions,
                            COUNT(DISTINCT user_id) as unique_users,
                            DATE_FORMAT(MIN(login_time), '%Y-%m-%d') as earliest_date,
                            DATE_FORMAT(MAX(login_time), '%Y-%m-%d') as latest_date
                          FROM sessions");
        return $this->db->single();
    }
    
    // Obtenir le nombre de sessions par jour (pour graphiques)
    public function getSessionsByDay($days = 7) {
        $this->db->query("SELECT 
                            DATE(login_time) as date, 
                            COUNT(*) as count
                          FROM sessions
                          WHERE login_time >= DATE_SUB(CURDATE(), INTERVAL :days DAY)
                          GROUP BY DATE(login_time)
                          ORDER BY DATE(login_time)");
        $this->db->bind(':days', $days, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
}
?>
