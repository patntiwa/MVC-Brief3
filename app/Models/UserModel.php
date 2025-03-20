<?php
require_once '../Config/database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Ajouter un utilisateur
    public function createUser($username, $email, $password, $role_id) {
        try {
            $sql = "INSERT INTO users (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindParam(':role_id', $role_id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erreur lors de l'ajout d'utilisateur : " . $exception->getMessage();
            return false;
        }
    }

    // Récupérer tous les utilisateurs
    public function getUsers() {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des utilisateurs : " . $exception->getMessage();
            return [];
        }
    }

    // Récupérer un utilisateur par ID
    public function getById($id) {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $exception->getMessage();
            return null;
        }
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $username, $email, $role_id, $status) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email, role_id = :role_id, status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erreur lors de la mise à jour : " . $exception->getMessage();
            return false;
        }
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erreur lors de la suppression : " . $exception->getMessage();
            return false;
        }
    }

    public function findByEmail($email) {
        // Assuming you have a database connection set up
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les rôles
    public function getRoles() {
        try {
            $sql = "SELECT * FROM roles";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des rôles : " . $exception->getMessage();
            return [];
        }
    }

    // Count the total number of users
    public function countUsers() {
        $query = "SELECT COUNT(*) as total FROM users";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getRecentActivity() {
        // Implement the logic to get recent activity
        // Example:
        $query = "SELECT * FROM activity_log ORDER BY created_at DESC LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserLoginHistory($userId) {
        // Assuming you have a database connection set up
        $query = "SELECT * FROM login_history WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

