<?php
class AdminController extends Controller {
    private $userModel;
    private $sessionModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->sessionModel = new Session();
        
        // Vérifier si l'utilisateur est connecté et a le rôle admin
        if (!$this->isLoggedIn() || !$this->hasRole('admin')) {
            $this->redirect('/login');
            exit;
        }
    }
    
    /**
     * Affiche le tableau de bord administrateur
     */
    public function dashboard() {
        $users = $this->userModel->getAll();
        $activeSessions = $this->sessionModel->getActiveSessions();
        
        $this->view('admin/dashboard', [
            'pageTitle' => 'Tableau de bord administrateur',
            'users' => $users,
            'activeSessions' => $activeSessions
        ]);
    }
    
    /**
     * Affiche la page de gestion des utilisateurs
     */
    public function manageUsers() {
        $users = $this->userModel->getAll();
        $roleModel = new Role();
        $roles = $roleModel->getAll();
        
        $this->view('admin/manage-users', [
            'pageTitle' => 'Gestion des utilisateurs',
            'users' => $users,
            'roles' => $roles,
            'csrfToken' => Security::generateCsrfToken()
        ]);
    }
}
