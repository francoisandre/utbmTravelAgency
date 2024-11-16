<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';

function createTransportationIfNotExisting($packageId, $modeOfTransport, $details) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM transportation WHERE package_id = ? AND mode_of_transport = ?");
    $stmt->bind_param("is", $packageId, $modeOfTransport);
    $stmt->execute();

    if ($stmt->get_result()->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO transportation (package_id, mode_of_transport, details) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $packageId, $modeOfTransport, $details);
        $stmt->execute();
    }
}

// Check if the user is an administrator before adding mock data
goToLoginIfNotAdmin();

try {
    createTransportationIfNotExisting(1, 'airplane', 'Vol en classe affaires');
    createTransportationIfNotExisting(1, 'car_rental', 'Voiture de luxe avec chauffeur');
    createTransportationIfNotExisting(2, 'train', 'Train direct');
    createTransportationIfNotExisting(3, 'bus', 'Bus de transport local');
} catch (Exception $e) {
    $_GET['errorMessage'] = "Une erreur est survenue lors de la création des moyens de transport";
    include __DIR__.'/../../view/transportation.php';
    exit();
}

$_GET['successMessage'] = "Les moyens de transport fictifs ont été créés";
include __DIR__.'/../../view/transportation.php';
?>
