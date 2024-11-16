<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/feedbackUtils.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();


if (!isset($_GET["feedback_id"])) {
    $_GET['errorMessage'] = "Feedback ID is missing";
    include __DIR__.'/../../view/dashboard.php';  
    exit();
}

try {
    deleteFeedback($_GET["feedback_id"]);
} catch (Exception $e) {
    $_GET['errorMessage'] = "An error has occurred";
    include __DIR__.'/../../view/dashboard.php';  
    exit();
}

$_GET['successMessage'] = "The feedback has been deleted";
include __DIR__.'/../../view/dashboard.php'; 
?>
