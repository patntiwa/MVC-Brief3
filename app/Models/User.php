<?php

require_once __DIR__ . '/../Core/Database.php';
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getUserById($id){
        
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function createUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password, role_id, status) VALUES (?, ?, ?, 2, 'active')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $password]);
    }

}
