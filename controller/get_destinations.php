<?php
header('Content-Type: application/json');
include_once __DIR__.'/../db/dbConnection.php';

try {
    // Connexion à la base de données
    $conn = getDatabase();

    // Récupère les destinations uniques depuis la table travelpackages
    $stmt = $conn->query("SELECT DISTINCT destination FROM travelpackages");
    $destinations = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Renvoie les destinations en format JSON
    echo json_encode($destinations);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch destinations: ' . $e->getMessage()]);
}
?>
