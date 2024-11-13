<?php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/trip/db_functions.php'; // Chemin ajusté pour db_functions.php
include_once __DIR__.'/../util/userUtils.php';
include_once __DIR__.'/../util/loyaltyProgramUtils.php';

try {
    // Connexion à la base de données
    $pdo = getDatabase();

    // Exécution du fichier SQL pour créer les tables
    $sqlFile = '../sql/travel_agency.sql';
    $sql = file_get_contents($sqlFile);
    $statements = explode(";", $sql);

    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $pdo->exec($statement);
        }
    }
    echo "Tables de la base de données créées avec succès.<br/>";

    // Création des programmes de fidélité
    createLoyaltyProgram("Bronze", 5, 0, "#CD7F32;");
    createLoyaltyProgram("Silver", 10, 5, "#C0C0C0");
    createLoyaltyProgram("Gold", 15, 15, "#FFD700");
    createLoyaltyProgram("Platinium", 20, 50, "#E5E4E2;");
    echo "Programmes de fidélité ajoutés avec succès.<br/>";

    // Création des utilisateurs administrateurs
    createUser("francois.andre.perso@gmail.com", "toto", "Francois", "ANDRE", "0622422400", true);
    createUser("alexandre@gmail.com", "utbm", "Alexandre", "ANDRE", "0622422400", true);
    createUser("ayoub@gmail.com", "utbm", "Ayoub", "CHERAMAT", "07793559", true);
    createUser("jad@gmail.com", "utbm", "Jad", "KAHLAOUI", "07793558", true);
    echo "Administrateurs ajoutés avec succès.<br/>";

    // Ajout des données de test pour les packages
    $packageIdVacation = addPackage('vacation', 'Paris', 7, 1200.00, 'Itinerary for Paris trip');
    addAccommodation($packageIdVacation, 'hotel', 'single', 'Wi-Fi, Pool, Gym', '2024-10-01', '2024-10-08');
    addTransportation($packageIdVacation, 'airplane', 'Round-trip economy class flight');

    $packageIdAdventure = addPackage('adventure', 'New York', 5, 1500.00, 'Itinerary for New York trip');
    addAccommodation($packageIdAdventure, 'hostel', 'shared', 'Wi-Fi, Shared Kitchen', '2024-11-01', '2024-11-06');
    addTransportation($packageIdAdventure, 'bus', 'Private coach with Wi-Fi and reclining seats');

    $packageIdBusiness = addPackage('business', 'Tokyo', 3, 2000.00, 'Itinerary for Tokyo trip');
    addAccommodation($packageIdBusiness, 'hotel', 'executive', 'Wi-Fi, Business Center, Gym', '2024-12-01', '2024-12-04');
    addTransportation($packageIdBusiness, 'train', 'High-speed train with reserved seating');

    $packageIdLuxe = addPackage('luxe', 'Dubai', 4, 5000.00, 'Itinerary for Dubai trip');
    addAccommodation($packageIdLuxe, 'resort', 'luxury suite', 'Private Pool, Ocean View, Spa', '2024-12-05', '2024-12-09');
    addTransportation($packageIdLuxe, 'airplane', 'Private jet with luxury amenities');

    echo "Packages, hébergements et transports ajoutés avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
