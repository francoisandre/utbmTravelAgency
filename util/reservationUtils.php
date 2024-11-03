<?php 
include_once __DIR__."/../db/dbConnection.php";
include_once __DIR__."/../util/userUtils.php";

function getCurrentUserFutureReservations() {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM reservations WHERE client_id = ? and reservation_date >= NOW() ORDER BY reservation_date ASC");
    $req->execute([$user['client_id']]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($data == false) {
        return [];
    }
   return $data;
}

function getCurrentUserPreviousReservations() {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM reservations WHERE client_id = ? and reservation_date < NOW() ORDER BY reservation_date DESC");
    $req->execute([$user['client_id']]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
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

function createReservation($clientId, $reservationDate) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO reservations (client_id, reservation_date) VALUES (?, ?)"); 
    $req->execute([$clientId, $reservationDate]);
}



?>