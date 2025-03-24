<?php
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/DashboardController.php';

$route = $_GET['route'] ?? 'login';

switch ($route) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register(); // Nouvelle logique pour l'inscription
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;

    default:
        echo "Page introuvable.";
        break;
}
?>
