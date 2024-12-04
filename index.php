<?php

require_once __DIR__ . '/public/models/db.php';
require_once __DIR__ . '/public/controllers/CollectionController.php';
require_once __DIR__ . '/public/controllers/Authcontroller.php';

$controller = new CollectionController($pdo);
$authController = new AuthController();
$controller->index();

if ($_GET['url'] === 'auth/register') {
    $authController->register();
}