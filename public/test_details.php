<?php
// Fichier de test pour afficher les détails d'un film

require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/models/detailsModel.php';
require_once __DIR__ . '/../src/controllers/detailsControlleur.php';

// Récupère l'ID du film depuis l'URL (?id=1)
$filmId = $_GET['id'] ?? 1;

// Appelle le contrôleur
$controller = new detailsController();
$controller->showFilmDetails($filmId);
