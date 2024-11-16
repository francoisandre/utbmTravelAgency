<?php

function getBaseUrl() {
    $host = $_SERVER['HTTP_HOST'];

    $baseUrl = 'http://' . $host . '/utbmTravelAgency/'; 
    return $baseUrl;
}

?>


