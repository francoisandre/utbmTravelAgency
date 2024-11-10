<?php
include_once __DIR__.'/../db/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $packageType = $_POST['package_type'];
    $startDate = $_POST['start_date'];
    $numberOfTravelers = $_POST['number_of_travelers']; // Nouveau champ pour le nombre de voyageurs

    // Connexion à la base de données
    $conn = getDatabase();

    try {
        // Trouver l'ID du package en fonction du package_type sélectionné
        $stmt = $conn->prepare("SELECT package_id FROM travelpackages WHERE package_name = ?");
        $stmt->execute([$packageType]);
        $package = $stmt->fetch();

        if ($package) {
            // Insérer les informations de réservation dans la table `reservations`
            $sql = "INSERT INTO reservations (package_id, reservation_date, number_of_travelers) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Exécuter l'insertion avec le nombre de voyageurs
            $stmt->execute([$package['package_id'], $startDate, $numberOfTravelers]);

            echo "La réservation a été ajoutée avec succès.";
        } else {
            echo "Erreur : le package sélectionné est introuvable dans la base de données.";
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
