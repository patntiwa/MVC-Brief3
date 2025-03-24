<?php
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/ClientController.php';
require_once '../app/controllers/AdminController.php';

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

    case 'clientDashboard':
            session_start();
            if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) {
                $controller = new ClientController();
                $controller->dashboard();
            } else {
                header('Location: ?route=login');
                exit;
            }
    break;

    case 'adminDashboard':
        session_start();
        if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            $controller = new AdminController();
            $controller->dashboard();
        } else {
            header('Location: ?route=login');
            exit;
        }
        break;
    

    default:
        echo "Page introuvable.";
        break;
}
?>
