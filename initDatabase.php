<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'utbmTravelAgency', 'utbm', 'utbmTravelAgency');

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Charger le script SQL depuis un fichier
$sql = file_get_contents('sql/travel_agency.sql');

// Exécuter le script SQL
if ($conn->multi_query($sql)) {
    echo "Script SQL exécuté avec succès.";
} else {
    echo "Erreur lors de l'exécution du script : " . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
