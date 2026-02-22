<?php

/**
 * Admin Controller
 * Handles admin dashboard and CRUD operations
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once __DIR__ . '/../models/adminModel.php';
require_once __DIR__ . '/loginController.php';

class AdminController {
	private $model;

	public function __construct() {
		$this->model = new AdminModel();
	}

	/**
	 * Ensure current user is admin
	 * @return void
	 */
	private function ensureAdminAccess() {
		if (!is_user_logged_in() || !is_current_user_admin()) {
			redirect_to('/login');
		}
	}

	/**
	 * Show admin dashboard
	 * @return void
	 */
	public function showDashboard() {
		$this->ensureAdminAccess();

		$films = $this->model->getAllFilms();
		$rooms = $this->model->getAllRooms();
		$sceances = $this->model->getAllSceances();
		$users = $this->model->getAllUsers();
		$reservations = $this->model->getAllReservations();

		require __DIR__ . '/../views/admin.php';
	}

	/**
	 * Handle add film form
	 * @return void
	 */
	public function addFilm() {
		$this->ensureAdminAccess();

		$filmId = trim($_POST['filmId'] ?? '');
		if ($filmId === '') {
			$filmId = $this->model->generateFilmId();
		}

		$data = [
			'filmId' => $filmId,
			'filmTitle' => trim($_POST['filmTitle'] ?? ''),
			'filmAuthor' => trim($_POST['filmAuthor'] ?? ''),
			'filmDetail' => trim($_POST['filmDetail'] ?? ''),
			'filmCategory' => trim($_POST['filmCategory'] ?? ''),
			'filmTime' => (int)($_POST['filmTime'] ?? 0),
			'filmPoster' => trim($_POST['filmPoster'] ?? '')
		];

		if ($data['filmTitle'] === '') {
			$_SESSION['admin_error'] = 'Film title is required.';
			redirect_to('/admin');
		}

		$success = $this->model->addFilm($data);
		$_SESSION['admin_message'] = $success ? 'Film added successfully.' : 'Failed to add film.';
		redirect_to('/admin');
	}

	/**
	 * Handle update film form
	 * @return void
	 */
	public function updateFilm() {
		$this->ensureAdminAccess();

        $filmId = trim($_POST['filmId'] ?? '');
        if ($filmId === '') {
            $_SESSION['admin_error'] = 'Film ID is required for update.';
            redirect_to('/admin');
        }

        $data = [
            'filmTitle' => trim($_POST['filmTitle'] ?? ''),
            'filmAuthor' => trim($_POST['filmAuthor'] ?? ''),
            'filmDetail' => trim($_POST['filmDetail'] ?? ''),
            'filmCategory' => trim($_POST['filmCategory'] ?? ''),
            'filmTime' => (int)($_POST['filmTime'] ?? 0),
            'filmPoster' => trim($_POST['filmPoster'] ?? '')
        ];

        $success = $this->model->updateFilm($filmId, $data);
        $_SESSION['admin_message'] = $success ? 'Film updated successfully.' : 'Failed to update film (no changes or invalid data).';
        redirect_to('/admin');
    }

    /**
     * Handle delete film form
     * @return void
     */
	public function deleteFilm() {
		$this->ensureAdminAccess();

		$filmId = trim($_POST['filmId'] ?? '');
		if ($filmId === '') {
			$_SESSION['admin_error'] = 'Film ID is required for deletion.';
			redirect_to('/admin');
		}

		$success = $this->model->deleteFilm($filmId);
		$_SESSION['admin_message'] = $success ? 'Film deleted successfully.' : 'Failed to delete film.';
		redirect_to('/admin');
	}

	/**
	 * Handle add sceance form
	 * @return void
	 */
	public function addSceance() {
		$this->ensureAdminAccess();

		$sceanceId = trim($_POST['sceanceId'] ?? '');
		if ($sceanceId === '') {
			$sceanceId = $this->model->generateSceanceId();
		}
		$sceanceDateRaw = trim($_POST['sceanceDate'] ?? '');
		$filmId = trim($_POST['filmId'] ?? '');
		$roomId = (int)($_POST['roomId'] ?? 0);

		if ($sceanceDateRaw === '' || $filmId === '' || $roomId === 0) {
			$_SESSION['admin_error'] = 'Date, film, and room are required.';
			redirect_to('/admin');
		}

		$sceanceDate = str_replace('T', ' ', $sceanceDateRaw) . ':00';
		$success = $this->model->addSceance($sceanceId, $sceanceDate, $filmId, $roomId);
		$_SESSION['admin_message'] = $success ? 'Sceance added successfully.' : 'Failed to add sceance.';
		redirect_to('/admin');
	}

	/**
	 * Handle delete sceance form
	 * @return void
	 */
	public function deleteSceance() {
		$this->ensureAdminAccess();

		$sceanceId = trim($_POST['sceanceId'] ?? '');
		if ($sceanceId === '') {
			$_SESSION['admin_error'] = 'Sceance ID is required for deletion.';
			redirect_to('/admin');
		}

		$success = $this->model->deleteSceance($sceanceId);
		$_SESSION['admin_message'] = $success ? 'Sceance deleted successfully.' : 'Failed to delete sceance.';
		redirect_to('/admin');
	}
}
