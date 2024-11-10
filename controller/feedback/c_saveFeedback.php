<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/feedbackUtils.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();


$rating = $_POST["rating"];
$comments = $_POST["comments"];
if ($_SESSION['feedbackEditionMode'] == "creation"){
    $reservationId=$_SESSION['editedfeedbackReservationId'];
    createfeedback($reservationId,$rating,$comments);
    $_GET['successMessage']="Feedback added";
include __DIR__.'/../../view/dashboard.php';
exit();
}
else{
    updateFeedback($_SESSION['editedFeedback']['feedback_id'] ,$rating,$comments);
    $_GET['successMessage']="Feedback added";
    include __DIR__.'/../../view/dashboard.php';
}

?>
