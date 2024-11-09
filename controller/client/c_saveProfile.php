<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotConnected();

$currentUser = getCurrentUser();
$userId = $currentUser['user_id'];

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

//We update some session variables as they could have changed
$_SESSION["email"] = $email;
$currentUser = getCurrentUser();
$_SESSION['currentUser'] = $currentUser;

$_GET['successMessage']="Information updated";
    include __DIR__.'/../../view/profile.php';

?>
