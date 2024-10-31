<?php 
include_once __DIR__."/dbConnection.php";

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


?>