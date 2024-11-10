<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();

$_SESSION['feedbackEditionMode'] = "creation";
$_SESSION['editedFeedback'] =  [
    "rating" => 0,
    "comments" => ""  
];

include __DIR__.'/../../view/feedback.php';

?>
