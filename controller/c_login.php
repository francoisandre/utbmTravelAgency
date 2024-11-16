<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';



if (!isset($_POST["email"])) {
$_GET['errorMessage']="Email is mandatory";
include __DIR__.'/../view/login.php';
exit();
}
if (!isset($_POST["passwd"])) {
    $_GET['errorMessage']="Password is mandatory";
    include __DIR__.'/../view/login.php';
    exit();
}
$email = $_POST["email"];
$password = $_POST["passwd"];


$db = getDatabase();


$req = $db->prepare("SELECT email, password FROM users WHERE email = ?");


$req->execute([$email]);


$data = $req->fetch();

if($data != null && password_verify($password, $data['password'])) {

    $_SESSION["email"] = $email;

    include __DIR__.'/../view/dashboard.php';
} else {
    $_GET['errorMessage']="incorrect password or email";
    include __DIR__.'/../view/login.php';
}

?>