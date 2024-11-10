<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/feedbackUtils.php';
include_once __DIR__.'/../../util/userUtils.php';


goToLoginIfNotConnected();

$_SESSION['feedbackEditionMode'] = "modification";
$_SESSION['editedFeedback'] =  getFeedbackByReservationId($_GET["reservationId"]);
include __DIR__.'/../../view/feedback.php';

?>