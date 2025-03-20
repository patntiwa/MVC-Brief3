<?php
// Charger les contrôleurs
require_once 'controllers/AuthController.php';

// Récupérer les paramètres de l'URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Appeler le bon contrôleur
switch ($controllerName) {
    case 'auth':
        $controller = new AuthController();
        break;
    // Vous pouvez ajouter d'autres contrôleurs ici
    default:
        die("Contrôleur non trouvé !");
}

// Appeler la méthode correspondante
if (method_exists($controller, $actionName)) {
    $controller->$actionName($_POST ?? []); // Passe les données POST si disponibles
} else {
    die("Action non trouvée !");
}
?>
