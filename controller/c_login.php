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

// Connexion à la base de données
$db = getDatabase();

// Préparation de la requête
$req = $db->prepare("SELECT email, password FROM users WHERE email = ?");

// Exécution de la requête paramétrée
$req->execute([$email]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null && password_verify($password, $data['password'])) {
    // C'est OK, on connecte l'utilisateur
    $_SESSION["email"] = $email;

    include __DIR__.'/../view/dashboard.php';
} else {
    $_GET['errorMessage']="incorrect password or email";
    include __DIR__.'/../view/login.php';
}

?>