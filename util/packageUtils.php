<?php
include_once __DIR__."/../db/dbConnection.php";  // Inclure la fonction de connexion à la base de données

function getAllPackages() {
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM travelpackages ORDER BY package_id ASC");
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($data == false) {
        return [];
    }
    return $data;
}

function getPackageById($packageId) {
    $db = getDatabase();
    try {
        $req = $db->prepare("SELECT * FROM travelpackages WHERE package_id = ?");
        $req->execute([$packageId]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error in getPackageById: " . $e->getMessage());
        return null;
    }
}

function createPackage($packageName, $destination, $duration, $price, $itinerary) {
    $db = getDatabase();
    try {
        $req = $db->prepare("INSERT INTO travelpackages (package_name, destination, duration, price, itinerary) VALUES (?, ?, ?, ?, ?)");
        $req->execute([$packageName, $destination, $duration, $price, $itinerary]);
    } catch (PDOException $e) {
        error_log("Database error in createPackage: " . $e->getMessage());
        return false;
    }
    return true;
}

function updatePackage($packageId, $packageName, $destination, $duration, $price, $itinerary) {
    $db = getDatabase();
    try {
        $req = $db->prepare("UPDATE travelpackages SET package_name = ?, destination = ?, duration = ?, price = ?, itinerary = ? WHERE package_id = ?");
        $req->execute([$packageName, $destination, $duration, $price, $itinerary, $packageId]);
    } catch (PDOException $e) {
        error_log("Database error in updatePackage: " . $e->getMessage());
        return false;
    }
    return true;
}

function deletePackage($packageId) {
    $db = getDatabase();
    try {
        $req = $db->prepare("DELETE FROM travelpackages WHERE package_id = ?");
        $req->execute([$packageId]);
    } catch (PDOException $e) {
        error_log("Database error in deletePackage: " . $e->getMessage());
        return false;
    }
    return true;
}
?>