<?php
header('Content-Type: application/json');
include_once __DIR__.'/../db/dbConnection.php';

try {
    // Connect to the database
    $conn = getDatabase();

    // Retrieve unique destinations from the travelpackages table
    $stmt = $conn->query("SELECT DISTINCT destination FROM travelpackages");
    $destinations = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Return destinations in JSON format
    echo json_encode($destinations);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch destinations: ' . $e->getMessage()]);
}
?>
