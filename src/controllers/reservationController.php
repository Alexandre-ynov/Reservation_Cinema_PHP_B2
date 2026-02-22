<?php

class ReservationController {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../models/reservationModel.php';
        $this->model = new ReservationModel();
    }

    /**
     * Shows pricing page with ticket types selection
     */
    public function showPricingPage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if booking data exists
        if (!isset($_SESSION['booking'])) {
            echo "Error: No booking session found.";
            return;
        }

        // Get booking data
        $booking = $_SESSION['booking'];
        $sceanceId = $booking['sceanceId'] ?? null;
        $seats = $booking['seats'] ?? [];
        $roomId = $booking['roomId'] ?? null;

        if (!$sceanceId || empty($seats)) {
            echo "Error: Invalid booking data.";
            return;
        }

        // Get reservation details
        $reservationDetails = $this->model->getReservationBySceanceId($sceanceId);
        $numberOfSeats = count($seats);

        // Include pricing view
        include __DIR__ . '/../views/pricing.php';
    }

    /**
     * Confirms a reservation by saving all selected seats to the database
     * Retrieves booking data from session and creates reservations
     */
    public function confirmReservation() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if booking data exists in session
        if (!isset($_SESSION['booking'])) {
            echo "Error: No booking session found.";
            return;
        }

        // Check if pricing data exists
        if (!isset($_POST['tickets']) || empty($_POST['tickets'])) {
            echo "Error: Please select at least one ticket.";
            return;
        }

        // Get booking data
        $booking = $_SESSION['booking'];
        $sceanceId = $booking['sceanceId'] ?? null;
        $seats = $booking['seats'] ?? [];
        $roomId = $booking['roomId'] ?? null;

        // Get user ID from session
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId || !$sceanceId || empty($seats)) {
            echo "Error: Invalid booking data.";
            return;
        }

        // Store ticket selections in session
        $_SESSION['booking']['tickets'] = $_POST['tickets'];
        $_SESSION['booking']['total'] = $_POST['total'] ?? 0;

        // Create reservation for each selected seat
        $reservationSuccessful = true;
        foreach ($seats as $seatId) {
            if (!$this->model->createReservation($userId, $roomId, $seatId, $sceanceId)) {
                $reservationSuccessful = false;
                break;
            }
        }

        if ($reservationSuccessful) {
            // Get reservation details for display
            $reservationDetails = $this->model->getReservationBySceanceId($sceanceId);
            
            // Save seat count before clearing session
            $totalSeatsReserved = count($seats);
            
            // Clear booking from session
            unset($_SESSION['booking']);

            // Include the reservation confirmation view
            include __DIR__ . '/../views/reservation.php';
        } else {
            echo "Error: Failed to create one or more reservations.";
        }
    }

    /**
     * Displays all reservations for the logged-in user
     */
    public function showUserReservations() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            echo "Error: User not logged in.";
            return;
        }

        // Get user's reservations
        $reservations = $this->model->getUserReservations($userId);

        // Include the reservation view
        include __DIR__ . '/../views/reservation.php';
    }
}
