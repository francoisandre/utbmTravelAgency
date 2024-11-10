<?php
include_once __DIR__."/../db/dbConnection.php";  // Inclure la fonction de connexion à la base de données

function getAllPackages() {
    // Récupérer la connexion à la base de données
    $db = getDatabase();

    // Requête pour récupérer tous les packages de la table "travelpackages"
    $req = $db->prepare("SELECT * FROM travelpackages ORDER BY package_id ASC");
    $req->execute();
    
    // Récupérer toutes les données sous forme de tableau associatif
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    
    // Retourner un tableau vide si aucune donnée n'est trouvée
    if ($data == false) {
        return [];
    }
    
    // Retourner les données
    return $data;
}
?>
