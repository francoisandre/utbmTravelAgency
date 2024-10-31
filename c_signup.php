<?php
// On vérifie que les infos ont été fournies
if(!isset($_POST["Email"]))
    return;
if(!isset($_POST["passwd"]))
    return;

if(!isset($_POST["First_name"]))
    return;

if(!isset($_POST["name"])) 
    return;

if(!isset($_POST["phone"]))
    return;

$email = $_POST["Email"];
$password = $_POST["passwd"];
$First_name = $_POST["First_name"];
$name = $_POST["name"];
$phone = $_POST["phone"];


// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=travel_agency_management_system;charset=utf8", "root", "");


// Préparation de la requête
$req = $db->prepare("INSERT INTO users (password, email) VALUES (?, ?)"); // A VERIFIER SELON NOM DE LA BDD

// Exécution de la requête paramétrée
$req->execute([password_hash($password, PASSWORD_DEFAULT), $email]);


$req2 = $db->prepare("INSERT INTO clients (first_name, last_name,phone_number) VALUES (?, ?,?)");
$req2->execute([$First_name, $name,$phone]);

// Pas de résultats à récupérer. Redirection de l'utilisateur vers la page de connexion.
header("Location: login.php"); // le view login.php et non le controller c_login.php
