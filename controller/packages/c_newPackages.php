<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

$_SESSION['packageEditionMode'] = "creation";
$_SESSION['editedPackage'] = [
    "package_name" => "",
    "destination" => "",
    "duration" => 1,
    "price" => 1,
    "itinerary" => ""
];

include __DIR__.'/../../view/packagesForm.php';
?>
