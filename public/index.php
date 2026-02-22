<?php

// Initialize database connection
$pdo = require_once __DIR__ . '/../src/config/database.php';

// Include controllers
require_once __DIR__ . '/../src/controllers/loginController.php';
require_once __DIR__ . '/../src/controllers/registerController.php';
require_once __DIR__ . '/../src/controllers/bookingController.php';
require_once __DIR__ . '/../src/controllers/detailsControlleur.php';

// Get the request URI and method
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove base path for subfolder deployment
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($base_path !== '' && strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}
if ($request_uri === '') {
    $request_uri = '/';
}

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
} elseif ($request_uri === '/details' && $request_method === 'GET') {
    $filmId = $_GET['filmId'] ?? null;
    if ($filmId) {
        require_once __DIR__ . '/../src/config/database.php';
        require_once __DIR__ . '/../src/models/detailsModel.php';
        $detailsController = new detailsController();
        $detailsController->showFilmDetails($filmId);
    } else {
        echo "Error: Film ID is required.";
    }
} elseif ($request_uri === '/booking' && $request_method === 'GET') {
    $sceanceId = $_GET['sceanceId'] ?? null;
    if ($sceanceId) {
        $bookingController = new BookingController();
        $bookingController->showBookingPage($sceanceId);
    } else {
        echo "Error: Session ID is required.";
    }
} elseif ($request_uri === '/booking/select' && $request_method === 'POST') {
    $bookingController = new BookingController();
    $bookingController->selectSeats();
} elseif ($request_uri === '/') {
    header('Location: /login');
    exit();
} else {
    http_response_code(404);
    echo "404 - Page not found";
} 
