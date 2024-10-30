<?php
// On vérifie que les infos ont été fournies
if (!isset($_POST["email"]))
    return;
if (!isset($_POST["passwd"]))
    return;

$email = $_POST["email"];
$password = $_POST["passwd"];

// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=travel_agency_management_system;charset=utf8", "root", "");

// Préparation de la requête
$req = $db->prepare("SELECT email, password FROM user WHERE email = ?");

// Exécution de la requête paramétrée
$req->execute([$email]);

// Récupération de l'éventuel résultat
$data = $req->fetch();

if($data != null && password_verify($password, $data['passwd'])) {
    // C'est OK, on connecte l'utilisateur
    session_start();
    $_SESSION["email"] = $email;

    // On le redirige sur son compte
    header("Location: ../view/account.php"); // A FAIRE PAS ENCORE DISPO
} else {
    // Erreur, utilisateur introuvable, on redirige vers le login
    header("Location: login.php"); // le view login.php et non le controller c_login.php
}