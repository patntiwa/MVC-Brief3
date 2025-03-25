<?php

require_once '../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    // ===== MÉTHODES UTILISATEUR =====

    // Récupérer un utilisateur par son ID
    public function getUserById($id)
    {
        $query = $this->db->prepare("SELECT u.*, r.name AS role_name
                                      FROM users u
                                      JOIN roles r ON u.role_id = r.id 
                                      WHERE u.id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son nom d'utilisateur
    public function getUserByUsername($username)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(['username' => $username]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("SELECT u.*, r.name AS role_name
                                      FROM users u
                                      JOIN roles r ON u.role_id = r.id 
                                      WHERE u.email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Inscrire un nouvel utilisateur (utilisateur normal)
    public function register($username, $email, $password)
    {
        // Vérifie d'abord si l'utilisateur existe déjà
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser) {
            return ['success' => false, 'message' => 'Cet email est déjà utilisé.'];
        }

        // Création de l'utilisateur avec un rôle "client" par défaut et statut actif
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->db->prepare(
            "INSERT INTO users (username, email, password, role_id, status)
             VALUES (:username, :email, :password, :role_id, :status)"
        );

        $result = $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role_id' => 2, // Client par défaut
            'status' => 'active', // Actif par défaut
        ]);

        if ($result) {
            return ['success' => true, 'message' => 'Utilisateur enregistré avec succès.'];
        } else {
            return ['success' => false, 'message' => 'Une erreur est survenue lors de l’inscription.'];
        }
    }

    // Ajouter un utilisateur (par exemple via admin)
    public function createUser($username, $email, $password, $role_id)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->db->prepare(
            "INSERT INTO users (username, email, password, role_id)
             VALUES (:username, :email, :password, :role_id)"
        );

        return $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role_id' => $role_id,
        ]);
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $username, $email, $role_id, $status)
    {
        $query = $this->db->prepare(
            "UPDATE users
             SET username = :username, email = :email, role_id = :role_id, status = :status
             WHERE id = :id"
        );

        return $query->execute([
            'username' => $username,
            'email' => $email,
            'role_id' => $role_id,
            'status' => $status,
            'id' => $id,
        ]);
    }

    // Supprimer un utilisateur (admin)
    public function deleteUser($id)
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    // Activer ou désactiver un utilisateur
    public function toggleStatus($id)
    {
        // Vérifie d'abord le statut actuel de l'utilisateur
        $query = $this->db->prepare("SELECT status FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Définit le nouveau statut
        $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';

        $update = $this->db->prepare("UPDATE users SET status = :status WHERE id = :id");
        return $update->execute(['status' => $newStatus, 'id' => $id]);
    }

    // ===== MÉTHODES ADMIN =====

    // Récupérer tous les utilisateurs avec leurs rôles
    public function getAllUsers()
    {
        $query = $this->db->prepare(
            "SELECT u.*, r.name AS role_name 
             FROM users u
             JOIN roles r ON u.role_id = r.id"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les rôles possibles
    public function getRoles()
    {
        $query = $this->db->prepare("SELECT * FROM roles");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsersWithRoles()
    {
        $query = $this->db->prepare(
            "SELECT u.id, u.username, u.email, u.status, r.name AS role_name 
            FROM users u
            JOIN roles r ON u.role_id = r.id"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
