<?php 
include_once __DIR__."/../db/dbConnection.php";
include_once __DIR__."/../util/userUtils.php";
include_once __DIR__.'/../util/loyaltyProgramUtils.php';

function getCurrentUserFutureReservations() {
    $user = getCurrentUser();
    $db = getDatabase();

    // Query to retrieve future bookings and their associated payment statuses
    $req = $db->prepare("
        SELECT r.*, p.payment_status 
        FROM reservations r 
        LEFT JOIN payments p ON r.reservation_id = p.reservation_id 
        WHERE r.client_id = ? 
        AND r.reservation_date >= NOW() 
        ORDER BY r.reservation_date ASC
    ");
    $req->execute([$user['client_id']]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);

    // If no data is returned, return an empty array
    if (empty($data)) {
        return [];
    }

    // Return the future bookings data
    return $data;
}

function getCurrentUserPreviousReservations() {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT r.reservation_id AS reservationId, r.*,f.* FROM reservations r LEFT JOIN feedback f ON f.reservation_id=r.reservation_id WHERE client_id = ? and reservation_date < NOW() ORDER BY reservation_date DESC");
    $req->execute([$user['client_id']]);
    $data = $req->fetchAll();
    if ($data == false) {
        return [];
    }
   return $data;
}

function getCurrentUserReservations() {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM reservations WHERE client_id = ? ORDER BY reservation_date ASC");
    $req->execute([$user['client_id']]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($data == false) {
        return [];
    }
   return $data;
}

function getClientReservations($clientId) {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM reservations WHERE client_id = ? ORDER BY reservation_date ASC");
    $req->execute([$clientId]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($data == false) {
        return [];
    }
   return $data;
}

function createReservation($clientId, $reservationDate) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO reservations (client_id, reservation_date) VALUES (?, ?)"); 
    $req->execute([$clientId, $reservationDate]);
    recomputeCurrentUserLoyaltyProgram();
}
function addNewTrip($destination, $start_date, $end_date, $price) {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=travel_agency', 'root', '');

    // Prepare and execute the insertion query
    $query = $db->prepare("INSERT INTO trips (destination, start_date, end_date, price) VALUES (?, ?, ?, ?)");
    return $query->execute([$destination, $start_date, $end_date, $price]);
}


?>