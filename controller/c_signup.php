<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../util/userUtils.php';
// On vérifie que les infos ont été fournies
if(!isset($_POST["email"])) {
    $_GET['errorMessage']="Le mél est obligatoire";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["passwd"])) {
    $_GET['errorMessage']="Le mot de passe est obligatoire";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["firstName"])) {
    $_GET['errorMessage']="Le prénom est obligatoire";
    include __DIR__.'/../view/signup.php';
    exit();
}
if(!isset($_POST["lastName"])) {
    $_GET['errorMessage']="Le nom est obligatoire";
    include __DIR__.'/../view/signup.php';
    exit();
}

if(!isset($_POST["phone"])) {
    $_GET['errorMessage']="Le numéro de téléphone est obligatoire";
    include __DIR__.'/../view/signup.php';
    exit();
}

$email = $_POST["email"];
$password = $_POST["passwd"];
$firstName = $_POST["firstName"];
$lastNname = $_POST["lastName"];
$phoneNumber = $_POST["phone"];


$db = getDatabase();

if (hasUserByEmail($email)) {
    $_GET['errorMessage']="Un utilisateur de même nom existe déja";
    include '../view/signup.php';
    exit();
} else {

    createUser($email, $password, $firstName, $lastNname, $phoneNumber, false);

$_GET['successMessage']="Votre compte a été créé";
$_SESSION["email"] = $email;
    include __DIR__.'/../view/dashboard.php';
}
