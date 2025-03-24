<?php
class Role {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAllRoles() {
        $this->db->query("SELECT * FROM roles");
        return $this->db->resultSet();
    }
    
    // Autres méthodes selon les besoins
}
?>
