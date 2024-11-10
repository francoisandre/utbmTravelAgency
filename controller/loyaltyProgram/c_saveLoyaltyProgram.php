<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/loyaltyProgramUtils.php';

goToLoginIfNotAdmin();

if(!isset($_SESSION['editedLoyaltyProgram'])) {
    $_GET['errorMessage']="No edited loyalty program";
    include __DIR__.'/../../view/loyaltyPrograms.php';
    exit();
}

$editedClient = $_SESSION['editedLoyaltyProgram'];


if(!isset($_POST["programName"])) {
    $_GET['errorMessage']="Program name is mandatory";
    include __DIR__.'/../../view/loyaltyProgram.php';
    exit();
}
if(!isset($_POST["discountPercentage"])) {
    $_GET['errorMessage']="Discount percentage is mandatory";
    include __DIR__.'/../../view/loyaltyProgram.php';
    exit();
}
if(!isset($_POST["requiredTripNumber"])) {
    $_GET['errorMessage']="Required trips numbers is mandatory";
    include __DIR__.'/../../view/loyaltyProgram.php';
    exit();
}

if(!isset($_POST["colorCode"])) {
    $_GET['errorMessage']="Color code is mandatory";
    include __DIR__.'/../../view/loyaltyProgram.php';
    exit();
}


$programName = $_POST["programName"];
$discountPercentage =  $_POST["discountPercentage"];
$requiredTripNumber = $_POST["requiredTripNumber"];
$colorCode = $_POST["colorCode"];

if ($_SESSION['loyaltyProgramEditionMode'] == "creation") {

    $existingLoyaltyProgram = getLoyaltyProgramByRequiredTripNumber($requiredTripNumber);
    if ($existingLoyaltyProgram == null) {
        //We can create the user
        createLoyaltyProgram($programName, $discountPercentage, $requiredTripNumber, $colorCode);
        recomputeClientLoyaltyProgram();
        $_GET['successMessage']="Loyalty program added";
        include __DIR__.'/../../view/loyaltyPrograms.php';
        exit;
    } else {
        $_GET['errorMessage']="Another program has the same required trips value";
        $_SESSION['editedLoyaltyProgram'] =  [
            "programName" => $programName,
            "discountPercentage" => $discountPercentage,
            "requiredTripNumber" => $requiredTripNumber,
            "colorCode" => $colorCode
        ];
        include __DIR__.'/../../view/loyaltyProgram.php';
        exit;
    }

}

$loyaltyProgramId = $_SESSION['editedLoyaltyProgram']['loyalty_program_id'];
updateLoyaltyProgram($loyaltyProgramId, $programName, $discountPercentage, $requiredTripNumber, $colorCode);
recomputeClientLoyaltyProgram();

$_GET['successMessage']="Information updated";
    include __DIR__.'/../../view/loyaltyPrograms.php';

?>
