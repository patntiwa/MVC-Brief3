<?php
// controllers/AuthController.php
require_once 'config/database.php'; // Inclure la connexion à la base de données
require_once 'models/User.php'; // Inclure le modèle User

class AuthController {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }
    public function register() {
        // Récupération des rôles depuis la base de données
        $roles = $this->user->getRoles();

        // Traitement du formulaire d'inscription
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $confirm_password = htmlspecialchars($_POST['confirm_password']);
            $role_id = intval($_POST['role_id']);

            // Vérification que les mots de passe correspondent
            if ($password !== $confirm_password) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            try {
                // Enregistrement de l'utilisateur
                if ($this->user->register($username, $email, $password, $role_id)) {
                    header('Location: login.php');
                    exit();
                } else {
                    echo "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }

        // Affichage du formulaire d'inscription
        // controllers/AuthController.php
        $filePath = dirname(__DIR__) . '/views/auth/register.php';
        // Vérification si le fichier existe avant de l'inclure
        if (file_exists($filePath)) {
            include $filePath;
        } else {
            die("Erreur : Le fichier de vue '$filePath' est introuvable.");
        }

    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->user->login($email, $password);
            if ($user) {
                // Démarrage de la session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];
                header('Location: dashboard.php');
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
        // Afficher le formulaire de connexion
        include __DIR__ . '/../views/auth/login.php';
    }
}
