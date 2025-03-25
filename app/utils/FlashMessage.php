<?php

class FlashMessage
{
    // Ajouter un message flash
    public static function add($type, $message)
    {
        $_SESSION['flash'][] = [
            'type' => $type, // Exemple : 'success', 'error', ou 'info'
            'message' => $message,
        ];
    }

    // Afficher les messages flash existants
    public static function display()
    {

        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $flash) {
                // Les classes Tailwind dépendront du type (success, error ou info)
                $bgColor = match ($flash['type']) {
                    'success' => 'bg-green-100 border-green-500 text-green-700',
                    'error' => 'bg-red-100 border-red-500 text-red-700',
                    'info' => 'bg-blue-100 border-blue-500 text-blue-700',
                    default => 'bg-gray-100 border-gray-500 text-gray-700',
                };

                echo "<div class='flash-message border-l-4 p-4 mb-4 shadow-lg transition duration-300 ease-in-out transform-gpu hover:scale-105 {$bgColor}'>
                        <p class='font-semibold'>{$flash['message']}</p>
                      </div>";
            }
            // Une fois affichés, supprimer les messages flash
            unset($_SESSION['flash']);
        }
    }
}
