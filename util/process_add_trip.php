<?php
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/tripUtils.php';
goToLoginIfNotConnected();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les informations du formulaire
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $price = $_POST['price'];

    // Appelle la fonction pour ajouter le voyage
    $result = addNewTrip($destination, $start_date, $end_date, $price);

    // Vérifie si l'ajout a été un succès
    if ($result) {
        header('Location: dashboard.php?message=Trip added successfully');
    } else {
        echo "Error: The trip could not be added.";
    }
}
?>
