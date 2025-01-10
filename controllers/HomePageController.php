<?php

namespace App\Controllers;

class HomePageController {
    public function index() {
        require_once __DIR__ . '/../views/homePageView.php';
    }
}
