<?php
class ClientController extends Controller {
    private $userModel;
    private $sessionModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->sessionModel = new Session();
        
        // Vérifier si l'utilisateur est connecté
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
            exit;
        }
    }
    
    /**
     * Affiche le tableau de bord client
     */
    public function dashboard() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);
        $sessions = $this->sessionModel->getByUserId($userId);
        
        $this->view('client/dashboard', [
            'pageTitle' => 'Tableau de bord client',
            'user' => $user,
            'sessions' => $sessions
        ]);
    }
    
    /**
     * Affiche la page de profil
     */
    public function profile() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);
        
        $this->view('client/profile', [
            'pageTitle' => 'Mon profil',
            'user' => $user,
            'csrfToken' => Security::generateCsrfToken()
        ]);
    }
}
