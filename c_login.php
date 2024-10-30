<?php

include_once 'db/dbConnection.php';

// On vérifie que les infos ont été fournies
if (!isset($_POST["email"]))
    return;
if (!isset($_POST["passwd"]))
    return;

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

if($data != null && password_verify($password, $data['passwd'])) {
    // C'est OK, on connecte l'utilisateur
    session_start();
    $_SESSION["email"] = $email;

    // On le redirige sur son compte
    header("Location: ../view/account.php"); // A FAIRE PAS ENCORE DISPO
} else {
    // Erreur, utilisateur introuvable, on redirige vers le login
    $_GET['errorCode']="UNKNOWN_CODE";
    include './login.php';
    //header("Location: login.php?error=LoginError"); // le view login.php et non le controller c_login.php
}