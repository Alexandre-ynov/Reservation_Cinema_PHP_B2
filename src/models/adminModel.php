<?php

class AdminModel {
	private $db;

	public function __construct() {
		require_once __DIR__ . '/../config/database.php';
		$this->db = Database::getConnection();
	}

	/**
	 * Generate a unique film ID
	 * @return string
	 */
	public function generateFilmId() {
		return 'FILM_' . uniqid();
	}

	/**
	 * Generate a unique sceance ID
	 * @return string
	 */
	public function generateSceanceId() {
		return 'SCEANCE_' . uniqid();
	}

	/**
	 * Create a new film
	 * @param array $data Film data
	 * @return bool True on success, false otherwise
	 */
	public function addFilm($data) {
		try {
			$sql = "INSERT INTO film (filmId, filmTitle, filmAuthor, filmDetail, filmCategory, filmTime, filmPoster)
					VALUES (:filmId, :filmTitle, :filmAuthor, :filmDetail, :filmCategory, :filmTime, :filmPoster)";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([
				':filmId' => $data['filmId'],
				':filmTitle' => $data['filmTitle'],
				':filmAuthor' => $data['filmAuthor'],
				':filmDetail' => $data['filmDetail'],
				':filmCategory' => $data['filmCategory'],
				':filmTime' => $data['filmTime'],
				':filmPoster' => $data['filmPoster']
			]);
		} catch (PDOException $e) {
			echo "Error adding film: " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Update an existing film (only provided fields are updated)
	 * @param string $filmId Film ID (required)
	 * @param array $data Film data to update (optional fields)
	 * @return bool True on success, false otherwise
	 */
	public function updateFilm($filmId, $data) {
		try {
			$updates = [];
			$params = [':filmId' => $filmId];

			if (!empty($data['filmTitle'])) {
				$updates[] = "filmTitle = :filmTitle";
				$params[':filmTitle'] = $data['filmTitle'];
			}
			if (!empty($data['filmAuthor'])) {
				$updates[] = "filmAuthor = :filmAuthor";
				$params[':filmAuthor'] = $data['filmAuthor'];
			}
			if (!empty($data['filmDetail'])) {
				$updates[] = "filmDetail = :filmDetail";
				$params[':filmDetail'] = $data['filmDetail'];
			}
			if (!empty($data['filmCategory'])) {
				$updates[] = "filmCategory = :filmCategory";
				$params[':filmCategory'] = $data['filmCategory'];
			}
			if (isset($data['filmTime']) && $data['filmTime'] > 0) {
				$updates[] = "filmTime = :filmTime";
				$params[':filmTime'] = $data['filmTime'];
			}
			if (!empty($data['filmPoster'])) {
				$updates[] = "filmPoster = :filmPoster";
				$params[':filmPoster'] = $data['filmPoster'];
			}

			if (empty($updates)) {
				return false; // Nothing to update
			}

			$sql = "UPDATE film SET " . implode(", ", $updates) . " WHERE filmId = :filmId";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute($params);
		} catch (PDOException $e) {
			echo "Error updating film: " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Delete a film by ID
	 * @param string $filmId Film ID
	 * @return bool True on success, false otherwise
	 */
	public function deleteFilm($filmId) {
		try {
			$sql = "DELETE FROM film WHERE filmId = :filmId";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([':filmId' => $filmId]);
		} catch (PDOException $e) {
			echo "Error deleting film: " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Create a new sceance
	 * @param string $sceanceId Sceance ID
	 * @param string $sceanceDate Sceance date (Y-m-d H:i:s)
	 * @param string $filmId Film ID
	 * @param int $roomId Room ID
	 * @return bool True on success, false otherwise
	 */
	public function addSceance($sceanceId, $sceanceDate, $filmId, $roomId) {
		try {
			$sql = "INSERT INTO sceance (sceanceId, sceanceDate, filmId, roomId)
					VALUES (:sceanceId, :sceanceDate, :filmId, :roomId)";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([
				':sceanceId' => $sceanceId,
				':sceanceDate' => $sceanceDate,
				':filmId' => $filmId,
				':roomId' => $roomId
			]);
		} catch (PDOException $e) {
			echo "Error adding sceance: " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Delete a sceance by ID
	 * @param string $sceanceId Sceance ID
	 * @return bool True on success, false otherwise
	 */
	public function deleteSceance($sceanceId) {
		try {
			$sql = "DELETE FROM sceance WHERE sceanceId = :sceanceId";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([':sceanceId' => $sceanceId]);
		} catch (PDOException $e) {
			echo "Error deleting sceance: " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Retrieve all users
	 * @return array
	 */
	public function getAllUsers() {
		try {
			$sql = "SELECT userId, userEmail, isAdmin FROM user_ ORDER BY userId";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error retrieving users: " . $e->getMessage();
			return [];
		}
	}

	/**
	 * Retrieve all films
	 * @return array
	 */
	public function getAllFilms() {
		try {
			$sql = "SELECT filmId, filmTitle, filmAuthor, filmDetail, filmCategory, filmTime, filmPoster
					FROM film ORDER BY filmTitle";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error retrieving films: " . $e->getMessage();
			return [];
		}
	}

	/**
	 * Retrieve all rooms
	 * @return array
	 */
	public function getAllRooms() {
		try {
			$sql = "SELECT roomId, roomNumberOfSeats, roomCharacteristic FROM room ORDER BY roomId";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error retrieving rooms: " . $e->getMessage();
			return [];
		}
	}

	/**
	 * Retrieve all sceances with film and room info
	 * @return array
	 */
	public function getAllSceances() {
		try {
			$sql = "SELECT s.sceanceId, s.sceanceDate, f.filmTitle, r.roomId
					FROM sceance s
					JOIN film f ON s.filmId = f.filmId
					JOIN room r ON s.roomId = r.roomId
					ORDER BY s.sceanceDate DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error retrieving sceances: " . $e->getMessage();
			return [];
		}
	}

	/**
	 * Retrieve all reservations with details
	 * @return array
	 */
	public function getAllReservations() {
		try {
			$sql = "SELECT r.userId, f.filmTitle, s.sceanceDate, r.roomId, r.seatId, st.seatRow, st.seatColumn
					FROM reservation r
					JOIN sceance s ON r.sceanceId = s.sceanceId
					JOIN film f ON s.filmId = f.filmId
					JOIN seat st ON r.roomId = st.roomId AND r.seatId = st.seatId
					ORDER BY s.sceanceDate DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error retrieving reservations: " . $e->getMessage();
			return [];
		}
	}
}
