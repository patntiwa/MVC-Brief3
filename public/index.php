<?php
// Démarrer la session
session_start();

// Charger les configurations
require_once '../app/config/config.php';

// Autoloader pour charger les classes
spl_autoload_register(function($className) {
    // Vérifier dans les différents répertoires
    $directories = [
        '../app/core/',
        '../app/controllers/',
        '../app/models/',
        '../app/helpers/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Initialiser le routeur
$router = new Router();

// Définir les routes
// Routes d'authentification
$router->get('/login', function() {
    $controller = new AuthController();
    $controller->loginPage();
});

$router->post('/login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->get('/register', function() {
    $controller = new AuthController();
    $controller->registerPage();
});

$router->post('/register', function() {
    $controller = new AuthController();
    $controller->register();
});

$router->get('/logout', function() {
    $controller = new AuthController();
    $controller->logout();
});

// Routes admin
$router->get('/admin/dashboard', function() {
    $controller = new AdminController();
    $controller->dashboard();
});

$router->get('/admin/users', function() {
    $controller = new AdminController();
    $controller->manageUsers();
});

// Routes client
$router->get('/client/dashboard', function() {
    $controller = new ClientController();
    $controller->dashboard();
});

$router->get('/client/profile', function() {
    $controller = new ClientController();
    $controller->profile();
});

// Route par défaut
$router->get('/', function() {
    if (isset($_SESSION['user_id']) && isset($_SESSION['role_id'])) {
        try {
            $roleModel = new Role();
            $role = $roleModel->getById($_SESSION['role_id']);
            
            if (!$role) {
                throw new Exception('Role invalide');
            }
            
            if ($role['name'] === 'admin') {
                header('Location: ' . BASE_URL . '/admin/dashboard');
            } else {
                header('Location: ' . BASE_URL . '/client/dashboard');
            }
            exit;
        } catch (Exception $e) {
            session_destroy();
            header('Location: ' . BASE_URL . '/login?error=session_invalid');
            exit;
        }
    } else {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
});

// Route 404
$router->setNotFound(function() {
    header("HTTP/1.0 404 Not Found");
    echo '<!DOCTYPE html>
          <html>
          <head>
              <title>404 - Page non trouvée</title>
              <style>
                  body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
                  h1 { color: #444; }
                  a { color: #0066cc; text-decoration: none; }
                  a:hover { text-decoration: underline; }
              </style>
          </head>
          <body>
              <h1>404 - Page non trouvée</h1>
              <p>La page que vous recherchez n\'existe pas.</p>
              <a href="' . BASE_URL . '">Retour à l\'accueil</a>
          </body>
          </html>';
});

// Exécuter le routeur
$router->run();

