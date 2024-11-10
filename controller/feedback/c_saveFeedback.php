<?php
include_once __DIR__.'/../../view/common/session.php';
include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/feedbackUtils.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();

$currentUser = getCurrentUser();
$userId = $currentUser['user_id'];
$reservation = getCurrentUserReservation($userId);
if (!$reservation) {
    $_GET['errorMessage'] = "No current reservation found for this user.";
    include __DIR__.'/../../view/dashboard.php'; 
    exit();
}

if (isset($_GET['reservation_id'])) {
    $reservationId = $_GET['reservation_id'];
} elseif (isset($_POST['reservation_id'])) {
    $reservationId = $_POST['reservation_id'];
} else {
    $_GET['errorMessage'] = "Reservation ID is missing.";
    include __DIR__ . '/../../view/dashboard.php'; 
    exit();
}

if(!isset($_POST["rating"])) {
    $_GET['errorMessage']="Rating is mandatory";
    include __DIR__.'/../../view/feedback.php';
    exit();
}

if(!isset($_POST["comments"])) {
    $_GET['errorMessage']="Comments are mandatory";
    include __DIR__.'/../../view/feedback.php';
    exit();
}

$reservationId = $_POST["reservation_id"];
$rating = $_POST["rating"];
$comments = $_POST["comments"];

updateFeedback($reservationId, $rating, $comments);

$currentUser = getCurrentUser();
$_SESSION['currentUser'] = $currentUser;

$_GET['successMessage']="Feedback updated";
include __DIR__.'/../../view/feedback.php';
?>
