<?php
include_once __DIR__.'/../view/common/session.php';
include_once __DIR__.'/../db/dbConnection.php';


// On vérifie que les infos ont été fournies
if (!isset($_POST["email"])) {
$_GET['errorMessage']="Le mél est obligatoire";
include __DIR__.'/../view/login.php';
exit();
}
if (!isset($_POST["passwd"])) {
    $_GET['errorMessage']="Le mot de passe est obligatoire";
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
    $_GET['errorMessage']="Erreur d'indentifiants";
    include __DIR__.'/../view/login.php';
}

?>