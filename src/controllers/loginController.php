<?php

/**
 * Login Controller
 * Handles user authentication and session management
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
require_once __DIR__ . '/../models/loginModel.php';

/**
 * Initialize user session after successful login
 * @param array $user_data User information from database
 * @return void
 */
function init_user_session($user_data) {
    $_SESSION['user_id'] = $user_data['userId'];
    $_SESSION['user_email'] = $user_data['userEmail'];
    $_SESSION['is_admin'] = $user_data['isAdmin'];
    $_SESSION['is_logged_in'] = true;
}

/**
 * Check if user is currently logged in
 * @return bool True if logged in, false otherwise
 */
function is_user_logged_in() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

/**
 * Get current logged in user ID
 * @return string|null User ID or null if not logged in
 */
function get_current_user_id() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Check if current user is admin
 * @return bool True if admin, false otherwise
 */
function is_current_user_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

/**
 * Destroy user session (logout)
 * @return void
 */
function destroy_user_session() {
    $_SESSION = [];
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    session_destroy();
}

/**
 * Redirect to a specific page
 * @param string $path Path to redirect to
 * @return void
 */
function redirect_to($path) {
    header("Location: $path");
    exit();
}
    