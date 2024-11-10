<?php
include_once __DIR__.'/../db/dbConnection.php';

function getFeedbackByReservationId($reservationId){
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM feedback  WHERE reservation_id = ?");
    $req->execute([$reservationId]);
    $feedback = $req->fetch(PDO::FETCH_ASSOC);
    return $feedback;
}


function updateFeedback($feedbackId, $rating, $comments) {
    $db = getDatabase();
    $req = $db->prepare("UPDATE feedback SET rating = ?, comments = ? WHERE feedback_id = ?");
    $req->execute([$rating, $comments, $feedbackId]);
}
function getCurrentUserReservation($userId) {
    $db = getDatabase();
    $req = $db->prepare("
        SELECT r.* FROM reservations r
        JOIN clients c ON r.client_id = c.client_id
        WHERE c.user_id = ? 
    ");
    $req->execute([$userId]);
    $reservation = $req->fetch(PDO::FETCH_ASSOC);
    return $reservation;
}

function deleteFeedback($feedbackId) {
    $db = getDatabase();
    
    // Vérifier si le feedback existe avant de tenter de le supprimer
    $req = $db->prepare("SELECT * FROM feedback WHERE feedback_id = ?");
    $req->execute([$feedbackId]);
    $data = $req->fetch();
    
    if ($data) {
        // Supprimer le feedback de la base de données
        $req = $db->prepare("DELETE FROM feedback WHERE feedback_id = ?");
        $req->execute([$feedbackId]);
    } else {
        throw new Exception("Feedback not found.");
    }
}
function createfeedback($reservationId, $rating, $comments) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO feedback (reservation_id, rating, comments) VALUES (?, ?, ?)");
    $req->execute([$reservationId, $rating, $comments]);
}

?>
