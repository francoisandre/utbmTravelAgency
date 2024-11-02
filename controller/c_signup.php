<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../util/userUtils.php';
// On vérifie que les infos ont été fournies
if(!isset($_POST["email"])) {
    $_GET['errorMessage']="Email is mandatory";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["passwd"])) {
    $_GET['errorMessage']="The password is compulsory";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["firstName"])) {
    $_GET['errorMessage']="The first name is compulsory";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["lastName"])) {
    $_GET['errorMessage']="The name is compulsory";
    include __DIR__.'/../view/signup.php';
    exit();
}

if(!isset($_POST["phone"])) {
    $_GET['errorMessage']="The telephone number is compulsory";
    include __DIR__.'/../view/signup.php';
    exit();
}

$email = $_POST["email"];
$password = $_POST["passwd"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$phoneNumber = $_POST["phone"];


$db = getDatabase();

if (hasUserByEmail($email)) {
    $_GET['errorMessage']="A user with the same name already exists";
    include '../view/signup.php';
    exit();
} else {

    createUser($email, $password, $firstName, $lastName, $phoneNumber, false);

$_GET['successMessage']="Your account has been created";
$_SESSION["email"] = $email;
    include __DIR__.'/../view/dashboard.php';
}
