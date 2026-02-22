<?php

/**
 * Home Controller
 * Handles home page display and user account management
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
require_once __DIR__ . '/loginController.php';

/**
 * Show home page
 * @return void
 */
function show_home_page() {
    // Redirect to login if not logged in
    if (!is_user_logged_in()) {
        redirect_to('/login');
    }
    
    require_once __DIR__ . '/../views/home.php';
}
