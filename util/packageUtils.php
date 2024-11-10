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
?>
