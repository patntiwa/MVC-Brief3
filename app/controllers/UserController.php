<?php
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/Auth.php';
require_once __DIR__.'/../utils/FlashMessage.php';
require_once __DIR__.'/../middleware/AuthMiddleware.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // ===== AUTHENTIFICATION =====

    // Afficher la page de connexion
    public function loginPage()
    {
        require_once __DIR__.'/../views/auth/login.php';
    }

    // Traiter la connexion utilisateur
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];
                header('Location: ?route=dashboard');
            } else {
                FlashMessage::add('error', 'Identifiants incorrects.');
                header('Location: ?route=loginPage');
            }
        }
    }

    // Traiter la déconnexion
    public function logout()
    {
        session_start();
        session_destroy();
        FlashMessage::add('success', 'Vous avez été déconnecté.');
        header('Location: /login');
        exit;
    }

    // ===== INSCRIPTION =====

    public function registerPage()
    {
        require_once __DIR__.'/../views/auth/register.php';
    }

    public function registerForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gestion de l'envoi du formulaire
            $username = trim(htmlspecialchars($_POST['username']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['confirm_password']);
            $role = htmlspecialchars($_POST['role']); // Rôle choisi par l'utilisateur
    
            // Liste blanche (les options sont déjà validées côté serveur)
            $roles = $this->userModel->getRoles(true); 
            $allowedRoleNames = array_column($roles, 'name'); // Extraire les noms des rôles
    
            if (!in_array($role, $allowedRoleNames)) {
                FlashMessage::add('error', 'Le rôle choisi n\'est pas autorisé.');
                header('Location: /register');
                exit;
            }
            // Validation des champs
            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                FlashMessage::add('error', 'Tous les champs sont obligatoires.');
                header('Location: /register');
                exit;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                FlashMessage::add('error', 'L\'adresse email est invalide.');
                header('Location: /register');
                exit;
            }
    
            if ($password !== $confirmPassword) {
                FlashMessage::add('error', 'Les mots de passe ne correspondent pas.');
                header('Location: /register');
                exit;
            }
    
            // Vérifier si l'utilisateur existe déjà
            if ($this->userModel->getUserByEmail($email)) {
                FlashMessage::add('error', 'Cet email est déjà utilisé.');
                header('Location: /register');
                exit;
            }
            // Obtenir l'ID du rôle à partir du nom (via le modèle)
            $roleId = $this->userModel->getRoleIdByName($role);
            if (!$roleId) {
                FlashMessage::add('error', 'Rôle invalide.');
                header('Location: ?route=registerPage');
                exit;
            }
            $result = $this->userModel->createUser($username, $email, $password, $roleId);
            if ($result) {
                FlashMessage::add('success', 'Inscription réussie.');
                header('Location: ?route=loginPage');
            } else {
                FlashMessage::add('error', 'Erreur lors de l\'inscription.');
                header('Location: ?route=registerPage');
            }
        }
    }
    
    // ===== DASHBOARD =====
    public function dashboard()
    {
        echo "Controleur atteint"; // Test
        Auth::checkAuth(); // Vérifie que l'utilisateur est connecté
        require_once __DIR__.'/../views/dashboard.php';
    }

    // ===== ADMINISTRATION (GESTION UTILISATEURS) =====

    public function listUsers()
    {
        AuthMiddleware::isAdmin();
        $users = $this->userModel->getAllUsersWithRoles();
        require_once 'app/views/usersManagement.php';
    }

    public function editUser($id)
    {
        AuthMiddleware::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour des données utilisateur
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $role_id = htmlspecialchars($_POST['role_id']);
            $status = htmlspecialchars($_POST['status']);

            $this->userModel->updateUser($id, $username, $email, $role_id, $status);

            FlashMessage::add('success', 'Utilisateur mis à jour avec succès.');
            header('Location: /list-users');
            exit;
        } else {
            // Charger l'utilisateur pour affichage
            $user = $this->userModel->getUserById($id);
            require_once 'app/views/editUser.php';
        }
    }
    
    public function deleteUser($id)
    {
        AuthMiddleware::isAdmin();
        $this->userModel->deleteUser($id);
        FlashMessage::add('success', 'Utilisateur supprimé.');
        header('Location: /list-users');
        exit;
    }
}
