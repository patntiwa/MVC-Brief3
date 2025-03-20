<?php
require_once 'models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel(); // Instanciation du modèle
    }

    // Afficher tous les utilisateurs
    public function index() {
        $users = $this->userModel->getUsers(); // Récupération des données via le modèle
        require_once 'views/users/List.php'; // Affichage via la vue
    }

    // Ajouter un utilisateur (formulaire de création)
    public function create() {
        require_once 'views/users/Create.php'; // Affichage du formulaire
    }

    // Soumettre le formulaire pour créer un utilisateur
    public function store($data) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role_id = $data['role_id'];

        $result = $this->userModel->createUser($username, $email, $password, $role_id);
        if ($result) {
            header('Location: index.php?controller=user&action=index'); // Rediriger vers la liste
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
        }
    }

    // Modifier un utilisateur (formulaire de modification)
    public function edit($id) {
        $user = $this->userModel->getById($id);
        require_once 'views/users/Edit.php'; // Affichage du formulaire de modification
    }

    // Soumettre le formulaire pour mettre à jour un utilisateur
    public function update($data) {
        $id = $data['id'];
        $username = $data['username'];
        $email = $data['email'];
        $role_id = $data['role_id'];
        $status = $data['status'];

        $result = $this->userModel->updateUser($id, $username, $email, $role_id, $status);
        if ($result) {
            header('Location: index.php?controller=user&action=index'); // Rediriger vers la liste
        } else {
            echo "Erreur lors de la mise à jour de l'utilisateur.";
        }
    }

    // Supprimer un utilisateur
    public function delete($id) {
        $result = $this->userModel->deleteUser($id);
        if ($result) {
            header('Location: index.php?controller=user&action=index'); // Rediriger
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];
    
        $user = $this->userModel->findByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            header('Location: index.php?controller=dashboard&action=index'); // Redirige vers le tableau de bord
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=auth&action=login'); // Redirige vers la connexion
    }

    public function dashboard() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $totalUsers = $this->userModel->countUsers();
        $recentActivity = $this->userModel->getRecentActivity();
        
        require_once 'views/users/dashboard.php';
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $user = $this->userModel->getById($_SESSION['user_id']);
        $loginHistory = $this->userModel->getUserLoginHistory($_SESSION['user_id']);
        
        require_once 'views/users/profile.php';
    }
}
?>
