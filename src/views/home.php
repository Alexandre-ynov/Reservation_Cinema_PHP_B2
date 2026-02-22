<?php
/**
 * Home View
 * Displays home page for logged in users with available movies
 */

// Start session to access user information
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set page title
$page_title = 'Home - Cinema Reservation';

// Include header
require_once __DIR__ . '/header.php';

// Get user information
$user_id = $_SESSION['user_id'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
$is_admin = $_SESSION['is_admin'] ?? false;

// Get selected category
$selected_category = $_GET['category'] ?? 'all';
$search_query = $_GET['search'] ?? '';

// Get error messages from session
$error_message = $_SESSION['error_message'] ?? '';

// Clear messages after displaying
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actuellement au cinéma</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #2d2d2d, #1a1a1a);
            font-family: Arial, sans-serif;
            color: white;
            min-height: 100vh;
        }
        
        .main-content {
            padding: 40px 20px;
        }
        
        .page-title {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 30px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .search-bar {
            max-width: 600px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 16px;
        }
        
        .search-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffc107;
        }
        
        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .search-btn {
            padding: 12px 24px;
            background: #ffc107;
            color: #1a1a1a;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .search-btn:hover {
            background: #ffb300;
        }
        
        .search-result-info {
            text-align: center;
            margin-bottom: 20px;
            color: #aaa;
            font-size: 14px;
        }
        
        .search-result-info a {
            color: #ffc107;
            text-decoration: none;
            margin-left: 10px;
        }
        
        .search-result-info a:hover {
            text-decoration: underline;
        }
        
        .filter-bar {
            max-width: 1400px;
            margin: 0 auto 40px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .filter-item {
            background: #3d3d3d;
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s;
            border: 1px solid #4d4d4d;
        }
        
        .filter-item:hover {
            background: #4d4d4d;
        }
        
        .filter-item.active {
            background: #ffc107;
            color: #1a1a1a;
            font-weight: bold;
        }
        
        .movies-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        
        .movie-card {
            background: transparent;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
            color: white;
        }
        
        .movie-card:hover {
            transform: translateY(-8px);
        }
        
        .movie-poster {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            background: #3d3d3d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }
        
        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .movie-info {
            padding: 15px 5px;
        }
        
        .movie-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }
        
        .movie-category {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 3px;
        }
        
        .movie-duration {
            font-size: 12px;
            color: #888;
        }
        
        .no-movies {
            text-align: center;
            padding: 60px 20px;
            font-size: 18px;
            color: #888;
        }
        
        .messages {
            max-width: 1400px;
            margin: 0 auto 20px;
            padding: 0 20px;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .alert-error {
            background: #e74c3c;
            color: white;
        }
        
        .alert-success {
            background: #27ae60;
            color: white;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h1 class="page-title">Actuellement au cinéma</h1>
    
    <div class="search-bar">
        <form method="GET" action="/home" class="search-form">
            <input type="text" 
                   name="search" 
                   class="search-input" 
                   placeholder="Rechercher un film..." 
                   value="<?php echo htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit" class="search-btn">Rechercher</button>
        </form>
    </div>
    
    <?php if (!empty($search_query)): ?>
        <div class="search-result-info">
            Résultats pour "<?php echo htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8'); ?>" 
            (<?php echo count($movies); ?> film<?php echo count($movies) > 1 ? 's' : ''; ?>)
            <a href="/home">✕ Effacer la recherche</a>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error_message)): ?>
        <div class="messages">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-error">
                    <strong>Erreur:</strong> <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="filter-bar">
        <a href="/home?category=all" class="filter-item <?php echo $selected_category === 'all' ? 'active' : ''; ?>">
            Tous les films
        </a>
        <?php foreach ($categories as $category): ?>
            <a href="/home?category=<?php echo urlencode($category); ?>" 
               class="filter-item <?php echo $selected_category === $category ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endforeach; ?>
    </div>
    
    <div class="movies-grid">
        <?php if (!empty($movies) && count($movies) > 0): ?>
            <?php foreach ($movies as $index => $movie): ?>
                <a href="/details?filmId=<?php echo urlencode($movie['filmId']); ?>" class="movie-card">
                    <div class="movie-poster">
                        <?php if (!empty($movie['filmPoster'])): ?>
                            <img src="/pictures/<?php echo htmlspecialchars($movie['filmPoster'], ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="<?php echo htmlspecialchars($movie['filmTitle'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            🎬
                        <?php endif; ?>
                    </div>
                        
                        <div class="movie-info">
                            <div class="movie-title">
                                <?php echo htmlspecialchars($movie['filmTitle'], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div class="movie-category">
                                <?php echo htmlspecialchars($movie['filmCategory'], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <?php if (!empty($movie['filmTime'])): ?>
                                <div class="movie-duration">
                                    <?php echo htmlspecialchars($movie['filmTime'], ENT_QUOTES, 'UTF-8'); ?> min
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-movies">
                <p>Aucun film disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
