<?php
header('Content-Type: application/json');
include_once __DIR__.'/../db/dbConnection.php';

if (!isset($_POST['package_type'])) {
    echo json_encode(['error' => 'Package type not set']);
    exit;
}

$package_type = $_POST['package_type'];

try {
    $conn = getDatabase();

 
    $stmt = $conn->prepare("SELECT DISTINCT accommodation_type FROM accommodations JOIN travelpackages ON accommodations.package_id = travelpackages.package_id WHERE travelpackages.package_name = ?");
    $stmt->execute([$package_type]);
    $accommodations = $stmt->fetchAll(PDO::FETCH_COLUMN);

    
    $stmt = $conn->prepare("SELECT DISTINCT mode_of_transport FROM transportation JOIN travelpackages ON transportation.package_id = travelpackages.package_id WHERE travelpackages.package_name = ?");
    $stmt->execute([$package_type]);
    $transportation = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        'accommodations' => $accommodations,
        'transportation' => $transportation
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch options: ' . $e->getMessage()]);
}
?>
