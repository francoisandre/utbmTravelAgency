<?php
$dbPath = realpath(__DIR__ . '/../../db/dbConnection.php');
if ($dbPath !== false) {
    include_once $dbPath;
} else {
    die("Erreur : Impossible de trouver dbConnection.php.");
}


// Fonction pour ajouter un package
function addPackage($packageName, $destination, $duration, $price, $itinerary) {
    $conn = getDatabase(); // Connexion à la base de données
    $sql = "INSERT INTO travelpackages (package_name, destination, duration, price, itinerary) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$packageName, $destination, $duration, $price, $itinerary]);
    return $conn->lastInsertId(); // Renvoie l'ID du package inséré
}

// Fonction pour ajouter un hébergement
function addAccommodation($packageId, $accommodationType, $roomType, $amenities, $checkInDate, $checkOutDate) {
    $conn = getDatabase();
    $sql = "INSERT INTO accommodations (package_id, accommodation_type, room_type, amenities, check_in_date, check_out_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$packageId, $accommodationType, $roomType, $amenities, $checkInDate, $checkOutDate]);
}

// Fonction pour ajouter un transport
function addTransportation($packageId, $modeOfTransport, $details) {
    $conn = getDatabase();
    $sql = "INSERT INTO transportation (package_id, mode_of_transport, details) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$packageId, $modeOfTransport, $details]);
}