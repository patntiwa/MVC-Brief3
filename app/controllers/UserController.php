public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulaire soumis en POST<br>";

            $input = trim($_POST['email']);
            $password = trim($_POST['password']);
            echo "Input reçu : $input, Password reçu<br>";

            if (empty($input) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
                echo $error; // Test
                require '../app/views/auth/login.php';
                return;
            }

            $userModel = new User();

            if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
                echo "Recherche par e-mail<br>";
                $user = $userModel->findByEmail($input);
            } else {
                echo "Recherche par nom d'utilisateur<br>";
                $user = $userModel->findByUsername($input);
            }

            var_dump($user); // Voir ce que renvoie la recherche

            if ($user && password_verify($password, $user['password'])) {
                echo "Utilisateur validé, rôle ID : " . $user['role_id'] . "<br>";
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];

                if ($user['role_id'] == 2) {
                    echo "Redirection vers clientDashboard<br>";
                    header('Location: ?route=clientDashboard');
                } else if ($user['role_id'] == 1) {
                    echo "Redirection vers adminDashboard<br>";
                    header('Location: ?route=adminDashboard');
                } else {
                    echo "Redirection inconnue<br>";
                    header('Location: ?route=unknownRole');
                }
                exit;
            } else {
                echo "Identifiants invalides<br>";
                $error = "Nom d'utilisateur/E-mail ou mot de passe incorrect.";
            }
        }
        require '../app/views/auth/login.php';
    }