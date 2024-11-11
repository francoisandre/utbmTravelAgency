<?php

function getBaseUrl() {
    $host = $_SERVER['HTTP_HOST'];
// Récupère le projet dans l'URL (cela peut varier en fonction de l'arborescence)
    $baseUrl = 'http://' . $host . '/utbmTravelAgency/';  // Remplace par le nom de ton projet
    return $baseUrl;
}

?>


