<?php 
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/packageUtils.php';
include_once __DIR__.'/../../util/userUtils.php';


goToLoginIfNotAdmin();


if (!isset($_GET["packageId"])) {
    $_GET['errorMessage']="package_id argument is missing";
    include __DIR__.'/../../view/packages.php';
    exit();
}

try {
    deletePackage($_GET["packageId"]);
}
catch (Exception $e) {
    $_GET['errorMessage']="An error has occured";
    include __DIR__.'/../../view/packages.php';
    exit();
}
$_GET['successMessage']="The package has been deleted";
    include __DIR__.'/../../view/packages.php';

?>
