<?php

namespace App\controllers;

class HomePageController {
    public function index() {
        require_once __DIR__ . '/../views/homePageView.php';
    }
}
