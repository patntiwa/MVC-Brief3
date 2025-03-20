<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Core/Controller.php';
 class AuthController  extends Controller{    
        public function login() {

        }
        public function register() {

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $username = trim($_POST['username']);
                        $email = trim($_POST['email']);
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
                        $userModel = new User();
                        $result = $userModel->createUser($username, $email, $password);
            
                        if ($result) {
                            header("Location: /login");
                            exit();
                        } else {
                            echo "Erreur lors de l'inscription.";
                        }
                    } else {
                        $this->render('auth/register');
                    }

        }
        public function logout() {
            
        }
}





