<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/packageUtils.php';
include_once __DIR__.'/../../util/userUtils.php';


goToLoginIfNotAdmin();

if (!isset($_GET["packageId"])) {
    $_GET['errorMessage']="package id parameter is mandatory";
    include __DIR__.'/../../view/packages.php';
    exit();
    }


$_SESSION['packageEditionMode'] = "modification";
// echo print_r(getPackageById($_GET["packageId"]));
$_SESSION['editedPackage'] =  getPackageById($_GET["packageId"]);
include __DIR__.'/../../view/packagesForm.php';

?>
