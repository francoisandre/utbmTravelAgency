<?php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../util/userUtils.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = getCurrentUser();
    if (!$user) {
        echo "Erreur : l'utilisateur n'est pas connecté.";
        exit;
    }

    $clientId = $user['client_id'];
    $packageType = $_POST['package_type'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $numberOfTravelers = $_POST['number_of_travelers'];

    $conn = getDatabase();

    try {
        $stmt = $conn->prepare("SELECT package_id FROM travelpackages WHERE package_name = ?");
        $stmt->execute([$packageType]);
        $package = $stmt->fetch();

        if ($package) {
            $sql = "INSERT INTO reservations (client_id, package_id, reservation_date, number_of_travelers) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$clientId, $package['package_id'], $startDate, $numberOfTravelers]);

            echo "<div style='text-align: center; margin-top: 20px;'>";
            echo "<h3>Reservation successfully added!</h3>";
            echo "<a href='../view/dashboard.php' class='btn btn-primary' style='margin-top: 15px;'>Return to Dashboard</a>";
            echo "</div>";
        } else {
            echo "Erreur : le package sélectionné est introuvable dans la base de données.";
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
