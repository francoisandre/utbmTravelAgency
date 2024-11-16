<?php
header('Content-Type: application/json');
include_once __DIR__.'/../db/dbConnection.php';

try {
    
    $conn = getDatabase();

    
    $stmt = $conn->query("SELECT DISTINCT destination FROM travelpackages");
    $destinations = $stmt->fetchAll(PDO::FETCH_COLUMN);

    
    echo json_encode($destinations);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch destinations: ' . $e->getMessage()]);
}
?>
