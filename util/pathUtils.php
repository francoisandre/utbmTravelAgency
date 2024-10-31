<?php

function getBaseUrl() {
    $host = $_SERVER['HTTP_HOST'];

    $requestUri = $_SERVER['REQUEST_URI'];
    $segments = explode('/', trim($requestUri, '/')); 
    $projectName = $segments[0]; 
    $baseUrl = 'http://' . $host . '/' . $projectName . '/';
    return $baseUrl;
}
?>