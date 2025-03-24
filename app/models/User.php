<?php
require_once '../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username){ 
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $email, $password, $role_id) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->conn->prepare('INSERT INTO users (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)');
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashed_password);
        $query->bindParam(':role_id', $role_id);

        return $query->execute();
    }
    // Méthode pour récupérer les rôles
    public function getRoles() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
