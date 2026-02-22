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
require_once __DIR__ . '/../models/homeModel.php';

/**
 * Show home page
 * @param PDO $pdo Database connection
 * @return void
 */
function show_home_page($pdo = null) {
    // Redirect to login if not logged in
    if (!is_user_logged_in()) {
        redirect_to('/login');
    }
    
    // Get movies from database if PDO connection is available
    $movies = [];
    $categories = [];
    $selected_category = $_GET['category'] ?? 'all';
    $search_query = $_GET['search'] ?? '';
    
    if ($pdo) {
        $categories = get_all_categories($pdo);
        
        if (!empty($search_query)) {
            // Search mode
            $movies = search_movies($pdo, $search_query);
        } elseif ($selected_category === 'all') {
            $movies = get_all_movies($pdo);
        } else {
            $movies = get_movies_by_category($pdo, $selected_category);
        }
    }
    
    require_once __DIR__ . '/../views/home.php';
}
