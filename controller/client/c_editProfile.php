<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();

$currentUser = getCurrentUser();
$_SESSION['currentUser'] = $currentUser;

include __DIR__.'/../../view/profile.php';

?>
