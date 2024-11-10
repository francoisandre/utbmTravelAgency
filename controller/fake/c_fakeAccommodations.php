<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';

function createAccommodationIfNotExisting($packageId, $accommodationType, $roomType, $amenities, $checkInDate, $checkOutDate) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM accommodations WHERE package_id = ? AND accommodation_type = ?");
    $stmt->bind_param("is", $packageId, $accommodationType);
    $stmt->execute();

    if ($stmt->get_result()->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO accommodations (package_id, accommodation_type, room_type, amenities, check_in_date, check_out_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $packageId, $accommodationType, $roomType, $amenities, $checkInDate, $checkOutDate);
        $stmt->execute();
    }
}

// Vérifie que l'utilisateur est un administrateur avant d'ajouter des données fictives
goToLoginIfNotAdmin();

try {
    createAccommodationIfNotExisting(1, 'hotel', 'Suite', 'Piscine, Spa, Wi-Fi gratuit', '2024-11-01', '2024-11-08');
    createAccommodationIfNotExisting(2, 'hostel', 'Chambre partagée', 'Wi-Fi gratuit', '2024-11-03', '2024-11-08');
    createAccommodationIfNotExisting(3, 'camping', 'Tente', 'Équipements de survie inclus', '2024-11-05', '2024-11-15');
} catch (Exception $e) {
    $_GET['errorMessage'] = "Une erreur est survenue lors de la création des hébergements";
    include __DIR__.'/../../view/accommodations.php';
    exit();
}

$_GET['successMessage'] = "Les hébergements fictifs ont été créés";
include __DIR__.'/../../view/accommodations.php';
?>