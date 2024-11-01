<?php 
include_once __DIR__."/../db/dbConnection.php";

function hasUserByEmail($email) {
    $db = getDatabase();
    $req = $db->prepare("SELECT COUNT(*) AS TOTAL FROM users WHERE email = ?");
    $req->execute([$email]);
    $data = $req->fetch();
    $rowCount = $data['TOTAL'];
    if ($rowCount ==0) {
        return false;
    } else {
        return true;
    }
}

function getUserNameByEmail($email) {
    $db = getDatabase();
    $req = $db->prepare("select first_name, last_name from clients, users where clients.user_id=users.user_id and email = ?");
    $req->execute([$email]);
    $data = $req->fetch();
    return $data['first_name']." ".$data['last_name'];
}

function isAdmin() {
    if (!isLogged()) {
        return false;
    } 
    else  {
        $email = $_SESSION['email'];
        $db = getDatabase();
        $req = $db->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute([$email]);
        $data = $req->fetch();
        return $data['isStaff'];
    }
}

function createUser($email, $password, $firstName, $lastName, $phoneNumber, $isStaff) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO users (password, email, isStaff) VALUES (?, ?, ?)"); 
    $req->execute([password_hash($password, PASSWORD_DEFAULT), $email, $isStaff]);

    $req = $db->prepare("SELECT user_id FROM users WHERE email = ?");
    $req->execute([$email]);
    $data = $req->fetch();
    $user_id = $data['user_id'];

    $req = $db->prepare("INSERT INTO clients (user_id,first_name, last_name,phone_number) VALUES (?, ?, ?,?)");
    $req->execute([$user_id, $firstName, $lastName,$phoneNumber]);
}

function isLogged() {
    return isset($_SESSION['email']);
}

function goToLoginIfNotConnected() {
    if (!isLogged()){
        $_GET['errorMessage']="Veuillez vous connecter";
        include_once __DIR__.'/../view/login.php';
        exit();
    }
}

function goToLoginIfNotAdmin() {
    if (!isAdmin()){
        $_GET['errorMessage']="Veuillez vous connecter en tant qu'administrateur";
        include_once __DIR__.'/../view/login.php';
        exit();
    }
}

function goToDashboardIfConnected() {
    if (isLogged()){
        include __DIR__.'/../view/dashboard.php';
        exit();
    }
}

?>