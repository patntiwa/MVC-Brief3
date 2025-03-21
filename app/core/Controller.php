<?php
class Controller {
    /**
     * Charge une vue
     * 
     * @param string $view Nom de la vue
     * @param array $data Données à passer à la vue
     * @return void
     */
    protected function view($view, $data = []) {
        // Rendre les données disponibles dans la vue
        extract($data);
        
        // Chemin vers le fichier de vue
        $viewFile = ROOT_PATH . "/app/views/$view.php";
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("Vue non trouvée: $viewFile");
        }
    }

    /**
     * Redirige vers une URL
     * 
     * @param string $url URL de redirection
     * @return void
     */
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }

    /**
     * Vérifie si l'utilisateur est connecté
     * 
     * @return bool
     */
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique
     * 
     * @param int|string $roleId ID ou nom du rôle requis
     * @return bool
     */
    protected function hasRole($roleId) {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        // Si c'est un nom de rôle au lieu d'un ID
        if (!is_numeric($roleId)) {
            // Récupérer le rôle de l'utilisateur depuis la base de données
            $db = Database::getInstance();
            $role = $db->fetch("SELECT r.name FROM roles r 
                             JOIN users u ON r.id = u.role_id 
                             WHERE u.id = ?", [$_SESSION['user_id']]);
            
            return $role && $role['name'] === $roleId;
        }
        
        return isset($_SESSION['role_id']) && $_SESSION['role_id'] == $roleId;
    }
}
