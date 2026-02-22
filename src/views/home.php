<?php
/**
 * Home View
 * Displays home page for logged in users
 */

// Start session to access user information
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get user information
$user_id = $_SESSION['user_id'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
$is_admin = $_SESSION['is_admin'] ?? false;

// Get error/success messages from session
$error_message = $_SESSION['error_message'] ?? '';
$success_message = $_SESSION['success_message'] ?? '';

// Clear messages after displaying
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Cinema Reservation</title>
</head>
<body>
    <h1>Welcome to Cinema Reservation</h1>
    
    <?php if (!empty($error_message)): ?>
        <div>
            <p><strong>Error:</strong> <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($success_message)): ?>
        <div>
            <p><strong>Success:</strong> <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    
    <h2>User Information</h2>
    <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Account Type:</strong> <?php echo $is_admin ? 'Admin' : 'Regular User'; ?></p>
    
    <h2>Account Actions</h2>
    <div>
        <a href="/logout">Logout</a>
    </div>
    
    <div>
        <h3>Delete Account</h3>
        <p>Warning: This action cannot be undone. All your reservations will be deleted.</p>
        <form action="/delete-account" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <button type="submit">Delete My Account</button>
        </form>
    </div>
    
    <hr>
    
    <h2>Navigation</h2>
    <ul>
        <li><a href="/reservation">My Reservations</a></li>
    </ul>
</body>
</html>
