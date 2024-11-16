<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

// Verify that the information has been provided
if (!isset($_GET["id"])) {
    $_GET['errorMessage']="id argument is missing";
    include __DIR__.'/../../view/clients.php';
    exit();
}

try {
    deleteLoyaltyProgram($_GET["id"]);
    recomputeClientLoyaltyProgram();
}
catch (Exception $e) {
    $_GET['errorMessage']="An error has occured";
    include __DIR__.'/../../view/loyaltyPrograms.php';
    exit();
}
$_GET['successMessage']="The loyalty program has been deleted";
    include __DIR__.'/../../view/loyaltyPrograms.php';

?>
