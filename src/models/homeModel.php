<?php

/**
 * Home Model
 * Handles database operations for home page
 */

/**
 * Get all available movies
 * @param PDO $pdo Database connection
 * @return array List of movies or empty array
 */
function get_all_movies($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT filmId, filmTitle, filmAuthor, filmDetail, filmCategory, filmTime, filmPoster FROM film ORDER BY filmTitle ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching movies: " . $e->getMessage());
        return [];
    }
}

/**
 * Get movie by ID
 * @param PDO $pdo Database connection
 * @param string $film_id Film ID
 * @return array|false Movie data or false if not found
 */
function get_movie_by_id($pdo, $film_id) {
    try {
        $stmt = $pdo->prepare("SELECT filmId, filmTitle, filmAuthor, filmDetail, filmCategory FROM film WHERE filmId = ?");
        $stmt->execute([$film_id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching movie by ID: " . $e->getMessage());
        return false;
    }
}

/**
 * Get movies by category
 * Handles multiple categories separated by /
 * @param PDO $pdo Database connection
 * @param string $category Film category
 * @return array List of movies or empty array
 */
function get_movies_by_category($pdo, $category) {
    try {
        $stmt = $pdo->prepare("SELECT filmId, filmTitle, filmAuthor, filmDetail, filmCategory, filmTime, filmPoster FROM film ORDER BY filmTitle ASC");
        $stmt->execute();
        $all_movies = $stmt->fetchAll();
        
        // Filter movies that have the category (handles multiple categories with /)
        $filtered_movies = [];
        foreach ($all_movies as $movie) {
            $categories = explode('/', $movie['filmCategory']);
            $categories = array_map('trim', $categories);
            
            if (in_array($category, $categories)) {
                $filtered_movies[] = $movie;
            }
        }
        
        return $filtered_movies;
    } catch (PDOException $e) {
        error_log("Error fetching movies by category: " . $e->getMessage());
        return [];
    }
}

/**
 * Get all unique categories from films
 * @param PDO $pdo Database connection
 * @return array List of unique categories
 */
function get_all_categories($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT DISTINCT filmCategory FROM film");
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        $categories = [];
        foreach ($results as $row) {
            // Split categories if multiple separated by /
            $cats = explode('/', $row['filmCategory']);
            foreach ($cats as $cat) {
                $cat = trim($cat);
                if (!empty($cat) && !in_array($cat, $categories)) {
                    $categories[] = $cat;
                }
            }
        }
        
        sort($categories);
        return $categories;
    } catch (PDOException $e) {
        error_log("Error fetching categories: " . $e->getMessage());
        return [];
    }
}

/**
 * Search movies by title
 * @param PDO $pdo Database connection
 * @param string $search_term Search term
 * @return array List of movies or empty array
 */
function search_movies($pdo, $search_term) {
    try {
        $search_pattern = "%" . strtolower($search_term) . "%";
        $stmt = $pdo->prepare("SELECT filmId, filmTitle, filmAuthor, filmDetail, filmCategory, filmTime, filmPoster FROM film WHERE LOWER(filmTitle) LIKE ? ORDER BY filmTitle ASC");
        $stmt->execute([$search_pattern]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error searching movies: " . $e->getMessage());
        return [];
    }
}
