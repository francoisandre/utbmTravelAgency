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


if(!isset($_POST["email"])) {
    $_GET['errorMessage']="Email is mandatory";
    include __DIR__.'/../../view/client.php';
    exit();
}
if(!isset($_POST["firstName"])) {
    $_GET['errorMessage']="First name is mandatory";
    include __DIR__.'/../../view/client.php';
    exit();
}
if(!isset($_POST["lastName"])) {
    $_GET['errorMessage']="Last name is mandatory";
    include __DIR__.'/../../view/client.php';
    exit();
}

if(!isset($_POST["phone"])) {
    $_GET['errorMessage']="Phone is mandatory";
    include __DIR__.'/../../view/client.php';
    exit();
}

if ($_SESSION['clientEditionMode'] == "creation") {
if(!isset($_POST["passwd"])) {
    $_GET['errorMessage']="Phone is mandatory";
    include __DIR__.'/../../view/client.php';
    exit();
}
}

$email = $_POST["email"];
$firstName =  $_POST["firstName"];
$lastName = $_POST["lastName"];
$phone = $_POST["phone"];

if ($_SESSION['clientEditionMode'] == "creation") {

    $password = $_POST["passwd"];
    $isStaff = false;
    $existingClient = getClientByEmail($email);
    if ($existingClient == null) {
        //We can create the user
        createUser($email, $password, $firstName, $lastName, $phone, $isStaff);
        $_GET['successMessage']="User added";
        include __DIR__.'/../../view/clients.php';
        exit;
    } else {
        $_GET['errorMessage']="This email is already used";
        $_SESSION['editedClient'] =  [
            "first_name" => $firstName,
            "last_name" => $lastName,
            "email" => $email,
            "phone_number" => $phone,
            "passwd" => $password
        ];
        include __DIR__.'/../../view/client.php';
        exit;
    }

}

$userId = $editedClient['user_id'];
updateUser($userId, $email, $firstName, $lastName, $phone);

$_GET['successMessage']="Information updated";
    include __DIR__.'/../../view/clients.php';

?>
