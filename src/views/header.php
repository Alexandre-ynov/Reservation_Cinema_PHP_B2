<?php
/**
 * Header View
 * Reusable header for all pages with navigation and user info
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get user information
$is_logged_in = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
$user_email = $_SESSION['user_email'] ?? '';
$is_admin = $_SESSION['is_admin'] ?? false;
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: Arial, sans-serif;
    }
    
    .main-header {
        background: linear-gradient(to right, #1a1a1a, #2d2d2d);
        padding: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }
    
    .header-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        height: 60px;
    }
    
    .logo {
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .logo span {
        color: #ffc107;
    }
    
    .nav-links {
        display: flex;
        list-style: none;
        gap: 30px;
        margin: 0;
        padding: 0;
    }
    
    .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s;
    }
    
    .nav-links a:hover {
        color: #ffc107;
    }
    
    .user-section {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .user-email {
        color: #ccc;
        font-size: 14px;
    }
    
    .btn-logout, .btn-login {
        background: #ffc107;
        color: #1a1a1a;
        padding: 8px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
    }
    
    .btn-logout:hover, .btn-login:hover {
        background: #ffb300;
    }
    
    .btn-admin {
        background: #e74c3c;
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
    }
    
    .btn-admin:hover {
        background: #c0392b;
    }
</style>

<header class="main-header">
    <div class="header-container">
        <a href="/home" class="logo">
            🎬 Cinema<span>SHARP</span>
        </a>
        
        <nav>
            <ul class="nav-links">
                <?php if ($is_logged_in): ?>
                    <li><a href="/home">Films</a></li>
                    <li><a href="/reservation">My Reservations</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <div class="user-section">
            <?php if ($is_logged_in): ?>
                <span class="user-email"><?php echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php if ($is_admin): ?>
                    <a href="/admin" class="btn-admin">Admin</a>
                <?php endif; ?>
                <a href="/logout" class="btn-logout">Logout</a>
            <?php else: ?>
                <a href="/login" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>
