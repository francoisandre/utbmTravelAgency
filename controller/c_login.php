<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';


// We check that the information has been provided
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

// Database connection
$db = getDatabase();

// Prepare the query
$req = $db->prepare("SELECT email, password FROM users WHERE email = ?");

// Execute the parameterized query
$req->execute([$email]);

// Retrieve the potential result
$data = $req->fetch();

if($data != null && password_verify($password, $data['password'])) {
    // It's OK, connecting the user
    $_SESSION["email"] = $email;

    include __DIR__.'/../view/dashboard.php';
} else {
    $_GET['errorMessage']="incorrect password or email";
    include __DIR__.'/../view/login.php';
}

?>