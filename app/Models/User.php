<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Trouve un utilisateur par son nom d'utilisateur
     */
    public function findByUsername($username) {
        return $this->db->fetch("SELECT * FROM users WHERE username = ?", [$username]);
    }
    
    /**
     * Trouve un utilisateur par son email
     */
    public function findByEmail($email) {
        return $this->db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
    }
    
    /**
     * Trouve un utilisateur par son ID
     */
    public function findById($id) {
        return $this->db->fetch("SELECT * FROM users WHERE id = ?", [$id]);
    }
    
    /**
     * Crée un nouvel utilisateur
     */
    public function create($username, $email, $password, $roleId = 2) { // 2 = Client par défaut
        $hashedPassword = Security::hashPassword($password);
        
        return $this->db->insert(
            "INSERT INTO users (username, email, password, role_id, status, created_at) 
             VALUES (?, ?, ?, ?, 'active', NOW())",
            [$username, $email, $hashedPassword, $roleId]
        );
    }
    
    /**
     * Met à jour un utilisateur
     */
    public function update($id, $data) {
        $fields = [];
        $values = [];
        
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        
        $values[] = $id;
        
        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        
        return $this->db->query($sql, $values);
    }
    
    /**
     * Supprime un utilisateur
     */
    public function delete($id) {
        return $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
    }
    
    /**
     * Récupère tous les utilisateurs
     */
    public function getAll() {
        return $this->db->fetchAll(
            "SELECT u.*, r.name as role_name 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             ORDER BY u.created_at DESC"
        );
    }
    
    /**
     * Active ou désactive un utilisateur
     */
    public function setStatus($id, $status) {
        return $this->db->query(
            "UPDATE users SET status = ? WHERE id = ?",
            [$status, $id]
        );
    }
}
