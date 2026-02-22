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

/**
 * Sanitize user input
 * @param string $input Raw input string
 * @return string Sanitized string
 */
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

/**
 * Validate email format
 * @param string $email Email address to validate
 * @return bool True if valid, false otherwise
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate login input data
 * @param string $email User email
 * @param string $password User password
 * @return array Array with 'valid' bool and 'errors' array
 */
function validate_login_input($email, $password) {
    $errors = [];
    
    // Check if email is empty
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!validate_email($email)) {
        $errors[] = "Invalid email format";
    }
    
    // Check if password is empty
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

/**
 * Get POST input safely
 * @param string $key POST key
 * @return string Sanitized POST value or empty string
 */
function get_post_input($key) {
    return isset($_POST[$key]) ? sanitize_input($_POST[$key]) : '';
}

/**
 * Handle user login request
 * @param PDO $pdo Database connection
 * @return array Response with success status and message
 */
function handle_login($pdo) {
    // Check if already logged in
    if (is_user_logged_in()) {
        return [
            'success' => false,
            'message' => 'Already logged in',
            'redirect' => '/home'
        ];
    }
    
    // Get and sanitize input
    $email = get_post_input('email');
    $password = get_post_input('password');
    
    // Validate input
    $validation = validate_login_input($email, $password);
    if (!$validation['valid']) {
        return [
            'success' => false,
            'errors' => $validation['errors']
        ];
    }
    
    // Verify credentials
    $user = verify_user_credentials($pdo, $email, $password);
    
    if (!$user) {
        return [
            'success' => false,
            'message' => 'Invalid email or password'
        ];
    }
    
    // Initialize session
    init_user_session($user);
    
    return [
        'success' => true,
        'message' => 'Login successful',
        'redirect' => '/home',
        'user' => $user
    ];
}

/**
 * Handle logout request
 * @return array Response with success status
 */
function handle_logout() {
    if (!is_user_logged_in()) {
        return [
            'success' => false,
            'message' => 'Not logged in'
        ];
    }
    
    destroy_user_session();
    
    return [
        'success' => true,
        'message' => 'Logout successful',
        'redirect' => '/login'
    ];
}
