<?php

// Initialize database connection
$pdo = require_once __DIR__ . '/../src/config/database.php';

// Include controllers
require_once __DIR__ . '/../src/controllers/loginController.php';
require_once __DIR__ . '/../src/controllers/registerController.php';

// Get the request URI and method
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Simple routing for testing
if ($request_uri === '/login' && $request_method === 'GET') {
    show_login_page();
} elseif ($request_uri === '/login' && $request_method === 'POST') {
    process_login($pdo);
} elseif ($request_uri === '/register' && $request_method === 'GET') {
    show_register_page();
} elseif ($request_uri === '/register' && $request_method === 'POST') {
    process_registration($pdo);
} elseif ($request_uri === '/logout') {
    process_logout();
} elseif ($request_uri === '/') {
    header('Location: /login');
    exit();
} else {
    http_response_code(404);
    echo "404 - Page not found";
} 
