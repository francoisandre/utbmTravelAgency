<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();


if (!isset($_GET["email"])) {
    $_GET['errorMessage']="Email argument is missing";
    include __DIR__.'/../../view/clients.php';
    exit();
}

try {
    deleteUser($_GET["email"]);
}
catch (Exception $e) {
    $_GET['errorMessage']="An error has occured";
    include __DIR__.'/../../view/clients.php';
    exit();
}
$_GET['successMessage']="The user has been deleted";
    include __DIR__.'/../../view/clients.php';

?>
