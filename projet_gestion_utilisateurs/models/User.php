<?php
// models/User.php
// models/User.php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Méthode pour enregistrer un utilisateur
    public function register($username, $email, $password, $role_id) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role_id', $role_id);
        return $stmt->execute();
    }

    // Méthode pour récupérer les rôles
    public function getRoles() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


