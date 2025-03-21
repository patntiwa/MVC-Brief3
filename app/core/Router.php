<?php
class Router {
    private $routes = [];
    private $notFoundCallback;

    /**
     * Ajoute une route au routeur
     * 
     * @param string $method Méthode HTTP (GET, POST)
     * @param string $path Chemin de l'URL
     * @param callable $callback Fonction à appeler pour cette route
     * @return void
     */
    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    /**
     * Ajoute une route GET
     */
    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    /**
     * Ajoute une route POST
     */
    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    /**
     * Fonction à appeler si aucune route n'est trouvée
     */
    public function setNotFound($callback) {
        $this->notFoundCallback = $callback;
    }

    /**
     * Exécute le routeur
     */
    public function run() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Traiter l'URL pour enlever les paramètres de requête
        $parsedUrl = parse_url($requestUri);
        $path = $parsedUrl['path'];
        
        // Supprimer le dossier de base si nécessaire
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        if ($basePath !== '/' && strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }
        
        // S'assurer que le chemin commence par /
        if (empty($path)) {
            $path = '/';
        }

        // Recherche de la route correspondante
        foreach ($this->routes as $route) {
            // Conversion du chemin de la route en expression régulière
            $pattern = $this->convertRouteToRegex($route['path']);
            
            if ($method === $route['method'] && preg_match($pattern, $path, $matches)) {
                // Supprimer le premier match (qui est la chaîne complète)
                array_shift($matches);
                
                // Appeler la fonction de callback avec les paramètres
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }

        // Si aucune route n'est trouvée, appeler la fonction 404
        if ($this->notFoundCallback) {
            call_user_func($this->notFoundCallback);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404 Page Not Found";
        }
    }

    /**
     * Convertit un chemin de route en expression régulière
     * 
     * @param string $route Chemin de la route (ex: "/users/:id")
     * @return string Expression régulière
     */
    private function convertRouteToRegex($route) {
        // Remplacer :param par une expression de capture
        $route = preg_replace('/\/:([^\/]+)/', '/([^/]+)', $route);
        
        // Ajouter les délimiteurs et ancres de début et de fin
        return '/^' . str_replace('/', '\/', $route) . '$/';
    }
}
