<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

$_SESSION['clientEditionMode'] = "creation";
$_SESSION['editedClient'] =  [
    "first_name" => "",
    "last_name" => "",
    "email" => "",
    "passwd" => "",
    "phone_number" => "",
];

include __DIR__.'/../../view/client.php';

?>
