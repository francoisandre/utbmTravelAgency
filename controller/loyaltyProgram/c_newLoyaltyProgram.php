<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

$_SESSION['loyaltyProgramEditionMode'] = "creation";
$_SESSION['editedLoyaltyProgram'] =  [
    "programName" => "",
    "discountPercentage" => 0,
    "requiredTripNumber" => 0,
    "colorCode" => "#FFFFFF",
];

include __DIR__.'/../../view/loyaltyProgram.php';

?>
