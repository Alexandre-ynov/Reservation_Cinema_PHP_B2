<?php
class detailsController {
    private $model;

    public function __construct() {
        $this->model = new detailsModel();
    }

    public function showDetails($id) {
        $film = $this->model->getFilmById($id);
        if ($film) {
            include __DIR__ . '/../views/details.php';
        } else {
            echo "Film not found.";
        }
    }
}