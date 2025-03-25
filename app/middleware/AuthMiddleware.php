<?php

class AuthMiddleware
{
    public static function isAdmin()
    {
        session_start();
        if ($_SESSION['role'] !== 'admin') {
            echo "Accès réservé à l'administrateur.";
            exit;
        }
    }
}
?>
