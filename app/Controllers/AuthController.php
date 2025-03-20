<?php
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel(); // Modèle utilisateur
    }

    // Affichage du formulaire d'inscription
    public function showRegistrationForm() {
        $roles = $this->userModel->getRoles(); // Récupérer les rôles
        require_once 'views/auth/register.php'; // Passer les rôles à la vue
    }

    // Traitement de l'inscription
    public function register($data) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role_id = $data['role_id'];

        $result = $this->userModel->createUser($username, $email, $password, $role_id);
        if ($result) {
            header('Location: index.php?controller=auth&action=login'); // Redirige vers la connexion
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}

