<?php
require_once '../app/models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
    public function login() {
        // Ajout d'un rapport d'erreur pour comprendre tout problème
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        // Vérifier si la méthode de requête est POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "Formulaire soumis en POST<br>";
    
            // Vérifier si les champs sont définis et non vides
            if (!isset($_POST['email'], $_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
                echo "L'un des champs est vide.<br>";
                $error = "Veuillez remplir tous les champs.";
                require '../app/views/auth/login.php';
                return;
            }
    
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            echo "Email reçu : {$email}<br>";
    
            // Instancier le modèle User et récupérer l'utilisateur
            $userModel = new User();
            $user = $userModel->findByEmail($email);
    
            if ($user) {
                echo "Utilisateur trouvé : " . print_r($user, true) . "<br>";
            } else {
                echo "Aucun utilisateur trouvé avec cet email.<br>";
            }
    
            // Vérifier si l'utilisateur et le mot de passe sont valides
            if ($user && password_verify($password, $user['password'])) {
                echo "Utilisateur validé, rôle ID : " . $user['role_id'] . "<br>";
    
                // Vérifier si une session a déjà été démarrée avant de la démarrer
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                    echo "Session démarrée.<br>";
                } else {
                    echo "Session déjà active.<br>";
                }
    
                // Enregistrer les informations de l'utilisateur dans la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];
    
                // Rediriger en fonction du rôle
                if ($user['role_id'] == 2) { // Rôle client
                    echo "Redirection vers clientDashboard<br>";
                    header('Location: ?route=clientDashboard');
                } else if ($user['role_id'] == 1) { // Rôle admin
                    echo "Redirection vers adminDashboard<br>";
                    header('Location: ?route=adminDashboard');
                } else {
                    echo "Redirection inconnue<br>";
                    header('Location: ?route=unknownRole');
                }
    
                // Terminer le script après une redirection
                exit;
            } else {
                // Mot de passe incorrect ou utilisateur introuvable
                echo "Mauvais identifiants ou mot de passe invalide.<br>";
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    
        // Inclure la vue de connexion
        require '../app/views/auth/login.php';
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

