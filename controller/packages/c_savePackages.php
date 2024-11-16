<?php
include_once __DIR__.'/../../view/common/session.php'; 
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/packageUtils.php';  
include_once __DIR__.'/../../util/userUtils.php';  
goToLoginIfNotAdmin();

if(!isset($_SESSION['editedPackage'])) {
    $_GET['errorMessage']="No edited package";
    include __DIR__.'/../../view/packages.php';
    exit();
}

$editedPackage = $_SESSION['editedPackage'];

// echo print_r($_POST);

if(!isset($_POST["package_name"])) {
    $_GET['errorMessage']="package name is mandatory";
    include __DIR__.'/../../view/packagesForm.php';
    exit();
}
if(!isset($_POST["destination"])) {
    $_GET['errorMessage']="destination is mandatory";
    include __DIR__.'/../../view/packagesForm.php';
    exit();
}
if(!isset($_POST["price"])) {
    $_GET['errorMessage']="Price is mandatory";
    include __DIR__.'/../../view/packagesForm.php';
    exit();
}

if(!isset($_POST["duration"])) {
    $_GET['errorMessage']="Duration is mandatory";
    include __DIR__.'/../../view/packagesForm.php';
    exit();
}

if(!isset($_POST["itinerary"])) {
    $_GET['errorMessage']="Itinerary description is mandatory";
    include __DIR__.'/../../view/packagesForm.php';
    exit();
}

$packageName = $_POST["package_name"];
$destination =  $_POST["destination"];
$price = $_POST["price"];
$duration = $_POST["duration"];
$itinerary = $_POST["itinerary"];

if ($_SESSION['packageEditionMode'] == "creation") {
    createPackage($packageName, $destination, $price, $duration,$itinerary);
        $_GET['successMessage']="Package added successfully";
        include __DIR__.'/../../view/packages.php';
        exit;

}
$packageId = $editedPackage['package_id'];
updatePackage($packageId, $packageName, $destination, $price, $duration, $itinerary);
$_GET['successMessage']="package updated successfully";
include __DIR__.'/../../view/packages.php';
?>
