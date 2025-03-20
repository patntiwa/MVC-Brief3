<?php
// /app/Models/Session.php
require_once '../Config/database.php';

class Session 
{
    protected $table = 'sessions';
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /**
     * Mettre à jour l'heure de déconnexion
     */
    public function updateLogoutTime($id)
    {
        $query = "UPDATE {$this->table} SET logout_time = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * Récupérer l'historique des sessions d'un utilisateur
     */
    public function getUserSessions($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY login_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Récupérer toutes les sessions avec les informations utilisateur
     */
    public function getAllWithUserInfo()
    {
        $query = "SELECT s.*, u.username FROM {$this->table} s
                  JOIN users u ON s.user_id = u.id
                  ORDER BY s.login_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}