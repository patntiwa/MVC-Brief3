<?php
require_once '../app/models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];
                header('Location: ?route=dashboard');
                exit;
            } else {
                $error = "Mauvais identifiants.";
            }
        } 

        // Afficher la vue login
        include '../app/views/auth/login.php';
    }
    public function logout() {
        // Détruire la session et rediriger vers la page de connexion
        session_start();
        session_unset();
        session_destroy();

        header('Location: ?route=login');
        exit;
    }
    // Nouvelle méthode pour l'inscription
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données POST
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm_password']);
            $role_id = trim($_POST['role_id']); // Récupérer l'identifiant de rôle sélectionné

            // Validation des données
            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || empty($role_id)) {
                $error = "Tous les champs sont obligatoires.";
                $roles = $this->userModel->getRoles(); // Obtenir la liste des rôles pour réafficher le formulaire
                require '../app/views/auth/register.php';
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "L'adresse e-mail n'est pas valide.";
                $roles = $this->userModel->getRoles();
                require '../app/views/auth/register.php';
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
                $roles = $this->userModel->getRoles();
                require '../app/views/auth/register.php';
                return;
            }

            // Vérifier si l'email ou le nom d'utilisateur existe déjà
            if ($this->userModel->findByUsername($username)) {
                $error = "Ce nom d'utilisateur est déjà utilisé.";
                $roles = $this->userModel->getRoles();
                require '../app/views/auth/register.php';
                return;
            }

            if ($this->userModel->findByEmail($email)) {
                $error = "Cet e-mail est déjà utilisé.";
                $roles = $this->userModel->getRoles();
                require '../app/views/auth/register.php';
                return;
            }

            // Appeler la méthode pour créer un utilisateur
            if ($this->userModel->createUser($username, $email, $password, $role_id)) {
                // Succès de l'inscription
                $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                require '../app/views/auth/login.php';
            } else {
                // Échec de l'inscription (par exemple, problème avec la base de données)
                $error = "Une erreur est survenue. Veuillez réessayer.";
                $roles = $this->userModel->getRoles();
                require '../app/views/auth/register.php';
            }
        } else {
            // Obtenir les rôles pour le formulaire
            $roles = $this->userModel->getRoles();
            require '../app/views/auth/register.php';
        }
    }
}

