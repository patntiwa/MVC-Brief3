<?php
class Role {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Récupère tous les rôles
     */
    public function getAll() {
        return $this->db->fetchAll("SELECT * FROM roles");
    }
    
    /**
     * Récupère un rôle par ID
     */
    public function getById($id) {
        return $this->db->fetch("SELECT * FROM roles WHERE id = ?", [$id]);
    }
    
    /**
     * Récupère un rôle par nom
     */
    public function getByName($name) {
        return $this->db->fetch("SELECT * FROM roles WHERE name = ?", [$name]);
    }
}
