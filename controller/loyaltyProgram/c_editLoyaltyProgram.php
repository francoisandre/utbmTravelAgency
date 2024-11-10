<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/loyaltyProgramUtils.php';

goToLoginIfNotAdmin();

if (!isset($_GET["id"])) {
    $_GET['errorMessage']="Id parameter is mandatory";
    include __DIR__.'/../../view/loyaltyPrograms.php';
    exit();
    }


$_SESSION['loyaltyProgramEditionMode'] = "edition";
$_SESSION['editedLoyaltyProgram'] = getLoyaltyProgramFromId($_GET["id"]);

include __DIR__.'/../../view/loyaltyProgram.php';

?>
