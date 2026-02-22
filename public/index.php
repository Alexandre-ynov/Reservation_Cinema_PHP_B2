<?php

// Initialize database connection
require_once __DIR__ . '/../src/config/database.php';
$pdo = Database::getConnection();

// Include controllers
require_once __DIR__ . '/../src/controllers/loginController.php';
require_once __DIR__ . '/../src/controllers/registerController.php';
require_once __DIR__ . '/../src/controllers/bookingController.php';
require_once __DIR__ . '/../src/controllers/detailsControlleur.php';
require_once __DIR__ . '/../src/controllers/reservationController.php';
require_once __DIR__ . '/../src/controllers/adminController.php';

// Simple redirect function for PHP Development Server
function redirect($path) {
    header('Location: ' . $path);
    exit();
}

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
} elseif ($request_uri === '/reservation' && $request_method === 'POST') {
    $reservationController = new ReservationController();
    $reservationController->confirmReservation();
} elseif ($request_uri === '/reservation' && $request_method === 'GET') {
    $reservationController = new ReservationController();
    $reservationController->showUserReservations();
} elseif ($request_uri === '/admin' && $request_method === 'GET') {
    $adminController = new AdminController();
    $adminController->showDashboard();
} elseif ($request_uri === '/admin/films/add' && $request_method === 'POST') {
    $adminController = new AdminController();
    $adminController->addFilm();
} elseif ($request_uri === '/admin/films/update' && $request_method === 'POST') {
    $adminController = new AdminController();
    $adminController->updateFilm();
} elseif ($request_uri === '/admin/films/delete' && $request_method === 'POST') {
    $adminController = new AdminController();
    $adminController->deleteFilm();
} elseif ($request_uri === '/admin/sceances/add' && $request_method === 'POST') {
    $adminController = new AdminController();
    $adminController->addSceance();
} elseif ($request_uri === '/admin/sceances/delete' && $request_method === 'POST') {
    $adminController = new AdminController();
    $adminController->deleteSceance();
} elseif ($request_uri === '/') {
    header('Location: /login');
    exit();
} else {
    http_response_code(404);
    echo "404 - Page not found";
} 
