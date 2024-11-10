<?php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../util/userUtils.php';
session_start();

// Vérifie que l'utilisateur est connecté
goToLoginIfNotConnected();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservationId = $_POST['reservation_id'];

    // Connexion à la base de données
    $conn = getDatabase();

    try {
        // Supprimer la réservation
        $stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_id = ?");
        $stmt->execute([$reservationId]);

        // Redirection vers le tableau de bord avec un message de succès
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

