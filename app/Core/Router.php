<?php 
class Router{
    public static function route($url){

        $url->post('/register', [AuthController::class, 'register']);
        $url->get('/register', [AuthController::class, 'register']);

    }
}