<?php
require_once '../app/core/helpers.php';
require_once '../config/routes.php';

$route = $_GET['route'] ?? 'login';
Router::dispatch($route);
?>

