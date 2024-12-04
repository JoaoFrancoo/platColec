<?php

require_once __DIR__ . '/public/models/db.php';
require_once __DIR__ . '/public/controllers/CollectionController.php';

$controller = new CollectionController($pdo);
$controller->index();
