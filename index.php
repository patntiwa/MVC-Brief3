<?php
session_start();
require_once __DIR__.'app/Config/Config.php';
require_once __DIR__.'app/Controllers/AuthController.php';
require_once __DIR__.'app/Controllers/UserController.php';

// Définir les routes par défaut
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Créer une instance du contrôleur approprié
switch ($controller) {
    case 'auth':
        $controllerInstance = new AuthController();
        break;
    case 'user':
        $controllerInstance = new UserController();
        break;
    default:
        die('Contrôleur non trouvé');
}

// Vérifier si la méthode existe
if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action($_POST);
} else {
    die('Action non trouvée');
}
?>
