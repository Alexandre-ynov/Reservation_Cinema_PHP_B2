<?php
/**
 * Login View
 * Displays login form for user authentication
 */

// Start session to access error messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get error messages from session
$error_message = $_SESSION['error_message'] ?? '';
$errors = $_SESSION['errors'] ?? [];

// Clear messages after displaying
unset($_SESSION['error_message'], $_SESSION['success_message'], $_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Cinema SHARP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            background: rgba(30, 30, 30, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .auth-subtitle {
            color: #aaa;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #ddd;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 193, 7, 0.2);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="checkbox"] {
            cursor: pointer;
            width: 16px;
            height: 16px;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-weight: 400;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 20px;
            background: #ffc107;
            color: #1a1a1a;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: #ffb300;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.15);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: #ff8a80;
        }

        .alert-error ul {
            margin: 8px 0 0 20px;
            padding: 0;
        }

        .alert-error li {
            margin: 4px 0;
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #aaa;
        }

        .auth-footer a {
            color: #ffc107;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-footer a:hover {
            color: #ffb300;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 30px 20px;
            }

            .auth-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="auth-header">
        <div class="auth-title">🎬 Cinema SHARP</div>
        <div class="auth-subtitle">Connectez-vous pour réserver</div>
    </div>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-error">
            <strong>Erreur :</strong> <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <strong>Erreurs de validation :</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="remember_me" name="remember_me" value="1">
            <label for="remember_me">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-submit">Se Connecter</button>
    </form>

    <div class="auth-footer">
        Pas encore inscrit ? <a href="/register">Créer un compte</a>
    </div>
</div>

</body>
</html>
