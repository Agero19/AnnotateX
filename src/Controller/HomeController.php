<?php
// src/Controller/HomeController.php

namespace Controller;
require_once __DIR__ . '/../utils.php';

class HomeController {
    public function index() {
        echo "Добро пожаловать на главную страницу!";

        view('home');
    }
}
