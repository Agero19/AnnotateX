<?php
// src/Controller/HomeController.php

namespace Controller;
use Core\Database;
require_once __DIR__ . '/../utils.php';

class HomeController {
    private $db;

    public function __construct() {
        // Load config
        $config = require __DIR__ . '/../../config/app.php';

        //Init the db connection
        $this->db = Database::getInstance($config['db'])->getConnection();
    }

    public function index() {
        view('home');
        $conn = $this->db;
        echo($conn ? "Good" : "Bad");
    }
}
