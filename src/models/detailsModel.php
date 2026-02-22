<?php
class detailsModel{
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getFilmById($id) {
        $query = "SELECT * FROM film WHERE filmId = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}