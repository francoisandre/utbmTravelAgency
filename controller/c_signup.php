<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/../db/userUtils.php';
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
$name = $_POST["lastName"];
$phone = $_POST["phone"];


$db = getDatabase();

if (hasUserByEmail($email)) {
    $_GET['errorMessage']="Un utilisateur de même nom existe déja";
    include '../view/signup.php';
    exit();
} else {

$req = $db->prepare("INSERT INTO users (password, email) VALUES (?, ?)"); 
$req->execute([password_hash($password, PASSWORD_DEFAULT), $email]);

$req = $db->prepare("SELECT user_id FROM users WHERE email = ?");
$req->execute([$email]);
$data = $req->fetch();
$user_id = $data['user_id'];

$req2 = $db->prepare("INSERT INTO clients (user_id,first_name, last_name,phone_number) VALUES (?, ?, ?,?)");
$req2->execute([$user_id, $firstName, $name,$phone]);

$_GET['successMessage']="Votre compte a été créé";
$_SESSION["email"] = $email;
    include __DIR__.'/../view/dashboard.php';
}
