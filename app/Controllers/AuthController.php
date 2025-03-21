<?php
class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    /**
     * Affiche la page de connexion
     */
    public function loginPage() {
        // Si déjà connecté, rediriger
        if ($this->isLoggedIn()) {
            $this->redirect('/');
            exit;
        }
        
        // Générer un token CSRF
        $csrfToken = Security::generateCsrfToken();
        
        $this->view('auth/login', [
            'csrfToken' => $csrfToken,
            'pageTitle' => 'Connexion'
        ]);
    }
    
    /**
     * Traite la connexion d'un utilisateur
     */
    public function login() {
        // Vérifier le token CSRF
        if (!isset($_POST['csrf_token']) || !Security::validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Token CSRF invalide';
            $this->redirect('/login');
            exit;
        }
        
        // Valider les données
        $username = Security::sanitize($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont requis';
            $this->redirect('/login');
            exit;
        }
        
        // Vérifier si l'utilisateur existe
        $user = $this->userModel->findByUsername($username);
        
        if (!$user || !Security::verifyPassword($password, $user['password'])) {
            $_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe incorrect';
            $this->redirect('/login');
            exit;
        }
        
        // Vérifier si le compte est actif
        if ($user['status'] !== 'active') {
            $_SESSION['error'] = 'Votre compte est inactif. Veuillez contacter un administrateur.';
            $this->redirect('/login');
            exit;
        }
        
        // Créer la session
        SessionManager::createUserSession($user);
        
        // Rediriger selon le rôle
        $roleModel = new Role();
        $role = $roleModel->getById($user['role_id']);
        
        if ($role['name'] === 'admin') {
            $this->redirect('/admin/dashboard');
        } else {
            $this->redirect('/client/dashboard');
        }
    }
    
    /**
     * Affiche la page d'inscription
     */
    public function registerPage() {
        // Si déjà connecté, rediriger
        if ($this->isLoggedIn()) {
            $this->redirect('/');
            exit;
        }
        
        // Générer un token CSRF
        $csrfToken = Security::generateCsrfToken();
        
        $this->view('auth/register', [
            'csrfToken' => $csrfToken,
            'pageTitle' => 'Inscription'
        ]);
    }
    
    /**
     * Traite l'inscription d'un utilisateur
     */
    public function register() {
        // Vérifier le token CSRF
        if (!isset($_POST['csrf_token']) || !Security::validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Token CSRF invalide';
            $this->redirect('/register');
            exit;
        }
        
        // Valider les données
        $username = Security::sanitize($_POST['username'] ?? '');
        $email = Security::sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';
        
        // Validation simple
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont requis';
            $this->redirect('/register');
            exit;
        }
        
        if ($password !== $passwordConfirm) {
            $_SESSION['error'] = 'Les mots de passe ne correspondent pas';
            $this->redirect('/register');
            exit;
        }
        
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Le mot de passe doit contenir au moins 8 caractères';
            $this->redirect('/register');
            exit;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email invalide';
            $this->redirect('/register');
            exit;
        }
        
        // Vérifier si l'utilisateur existe déjà
        if ($this->userModel->findByUsername($username)) {
            $_SESSION['error'] = 'Ce nom d\'utilisateur est déjà pris';
            $this->redirect('/register');
            exit;
        }
        
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Cet email est déjà utilisé';
            $this->redirect('/register');
            exit;
        }
        
        // Par défaut, attribuer le rôle client (id=2)
        $roleId = 2;
        
        // Créer l'utilisateur
        $userId = $this->userModel->create($username, $email, $password, $roleId);
        
        if (!$userId) {
            $_SESSION['error'] = 'Erreur lors de la création du compte';
            $this->redirect('/register');
            exit;
        }
        
        $_SESSION['success'] = 'Compte créé avec succès! Vous pouvez maintenant vous connecter.';
        $this->redirect('/login');
    }
    
    /**
     * Déconnecte l'utilisateur
     */
    public function logout() {
        SessionManager::destroyUserSession();
        $this->redirect('/login');
    }
}
