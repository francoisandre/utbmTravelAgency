<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

if(!isset($_SESSION['editedClient'])) {
    $_GET['errorMessage']="No edited client";
    include __DIR__.'/../../view/clients.php';
    exit();
}

$editedClient = $_SESSION['editedClient'];
$userId = $editedClient['user_id'];

if(!isset($_POST["email"])) {
    $_GET['errorMessage']="Email is mandatory";
    include __DIR__.'/../../view/profile.php';
    exit();
}
if(!isset($_POST["firstName"])) {
    $_GET['errorMessage']="First name is mandatory";
    include __DIR__.'/../../view/profile.php';
    exit();
}
if(!isset($_POST["lastName"])) {
    $_GET['errorMessage']="Last name is mandatory";
    include __DIR__.'/../../view/profile.php';
    exit();
}

if(!isset($_POST["phone"])) {
    $_GET['errorMessage']="Phone is mandatory";
    include __DIR__.'/../../view/profile.php';
    exit();
}


$email = $_POST["email"];
$firstName =  $_POST["firstName"];
$lastName = $_POST["lastName"];
$phone = $_POST["phone"];


updateUser($userId, $email, $firstName, $lastName, $phone);

$_GET['successMessage']="Information updated";
    include __DIR__.'/../../view/clients.php';

?>
