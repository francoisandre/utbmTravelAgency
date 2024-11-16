<?php

function getBaseUrl() {
    $host = $_SERVER['HTTP_HOST'];
// Retrieve the project from the URL (this may vary depending on the directory structure)
    $baseUrl = 'http://' . $host . '/utbmTravelAgency/';  // Remplace par le nom de ton projet
    return $baseUrl;
}

?>


