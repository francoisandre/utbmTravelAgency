<?php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../util/userUtils.php';
include_once __DIR__.'/../util/loyaltyProgramUtils.php';
session_start();

goToLoginIfNotConnected();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservationId = $_POST['reservation_id'];

    $conn = getDatabase();

    try {
       
        $stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_id = ?");
        $stmt->execute([$reservationId]);
        recomputeCurrentUserLoyaltyProgram();
        
        $_SESSION['message'] = "Reservation successfully deleted.";
        header("Location: ../view/dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

