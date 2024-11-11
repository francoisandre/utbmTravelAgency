<?php
// Ajustement des chemins selon l'arborescence
include_once __DIR__.'/../view/common/session.php';  // Chemin vers session.php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__ . '/../util/pathUtils.php';  // Chemin vers dbConfig.php ou dbConnection.php

// Affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Début du script<br>"; // Début du script

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Méthode POST confirmée<br>";

    // Vérification des données POST
    if (!isset($_POST['id_booking'])) {
        echo "The reservation ID is missing.";
        exit();
    }
    if (!isset($_POST['payment_method'])) {
        echo "The payment method is missing.";
        exit();
    }

    $reservation_id = $_POST['id_booking'];
    $payment_method = $_POST['payment_method'];
    $payment_date = date("Y-m-d H:i:s");
    $payment_status = "Completed";

    echo "Données POST : ";
    var_dump($reservation_id, $payment_method, $payment_status, $payment_date);

    // Connexion à la base de données
    $db = getDatabase();
    if ($db) {
        echo "Connexion réussie<br>";
    } else {
        echo "Échec de connexion à la base de données<br>";
        exit();
    }

    // Vérification que le `reservation_id` existe dans la table `reservations`
    $sqlCheck = "SELECT COUNT(*) FROM reservations WHERE reservation_id = ?";
    $stmtCheck = $db->prepare($sqlCheck);
    $stmtCheck->execute([$reservation_id]);
    $count = $stmtCheck->fetchColumn();

    if ($count == 0) {
        echo "L'identifiant de réservation n'existe pas dans la base de données.";
        exit();
    }

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO payments (reservation_id, payment_method, payment_status, payment_date) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);

    // Exécution de la requête avec les valeurs
    if ($stmt->execute([$reservation_id, $payment_method, $payment_status, $payment_date])) {
        echo "Insertion réussie, redirection vers le tableau de bord...<br>";

        // Utilisation de la base URL dynamique pour la redirection
        echo "URL générée: " . getBaseUrl() . "view/dashboard.php"; // Pour vérifier l'URL

        header("Location: " . getBaseUrl() . "view/dashboard.php?payment_success=1");
        exit();




    } else {
        // Affichage de l'erreur PDO
        $errorInfo = $stmt->errorInfo();
        echo "Erreur PDO : " . $errorInfo[2];
    }
} else {
    echo "Méthode de requête non POST<br>";
}
?>
