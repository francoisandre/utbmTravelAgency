<?php 
include_once __DIR__."/../db/dbConnection.php";
include_once __DIR__."/loyaltyProgramUtils.php";
include_once __DIR__."/reservationUtils.php";

function getPastTrips($clientId) {
    $db = getDatabase();
    $req = $db->prepare("SELECT reservation_date FROM reservations WHERE client_id = ? AND reservation_date < NOW()");
    $req->execute([$clientId]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
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

function deleteUser($email)  {
    if (hasUserByEmail($email)) {
        $db = getDatabase();
        $req = $db->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute([$email]);
        $data = $req->fetch();
        $userId = $data['user_id'];

        $req = $db->prepare("DELETE FROM clients WHERE user_id = ?");
        $req->execute([$userId]);

        $req = $db->prepare("DELETE FROM users WHERE user_id = ?");
        $req->execute([$userId]);
    }
}

function getCurrentUserName() {
    if (!isLogged()) {
        return "";
    } else {
    $user = getCurrentUser();
    return $user['first_name']." ".$user['last_name'];
    }
}

function getCurrentUser() {
    if (!isLogged()) {
        return null;
    } else {
        $db = getDatabase();
        $req = $db->prepare("select * from clients, users, loyaltyprograms where clients.user_id=users.user_id and email = ? and loyaltyprograms.loyalty_program_id = clients.loyalty_program_id");
        $req->execute([$_SESSION['email']]);
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

function getClients() {
    $db = getDatabase();
    $req = $db->prepare("select first_name, last_name, email, program_name from clients, users, loyaltyprograms where clients.user_id=users.user_id and isStaff= 0 and loyaltyprograms.loyalty_program_id = clients.loyalty_program_id");
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getClientByEmail($email) {
    $db = getDatabase();
    $req = $db->prepare("select first_name, last_name, email, phone_number, program_name, client_id,clients.user_id as user_id from clients, users, loyaltyprograms where clients.user_id=users.user_id and isStaff= 0 and loyaltyprograms.loyalty_program_id = clients.loyalty_program_id and email = ?");
    $req->execute([$email]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
    if ($data == false) {
        return null;
    }
    return $data;
}

function getAdmins() {
    $db = getDatabase();
    $req = $db->prepare("select first_name, last_name, email from clients, users where clients.user_id=users.user_id and isStaff= 1");
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
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
        return $data['isStaff']==1;
    }
}

function booleanToInt($value) {
    if ($value == true) {
        return 1;
    } else {
        return 0;
    }
}

function createUser($email, $password, $firstName, $lastName, $phoneNumber, $isStaff) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO users (password, email, isStaff) VALUES (?, ?, ?)"); 
    $req->execute([password_hash($password, PASSWORD_DEFAULT), $email, booleanToInt($isStaff)]);

    $req = $db->prepare("SELECT user_id FROM users WHERE email = ?");
    $req->execute([$email]);
    $data = $req->fetch();
    $user_id = $data['user_id'];
    $loyalty_program_id = getLoyaltyProgramIdFromTripNumber(0);
    $req = $db->prepare("INSERT INTO clients (user_id,first_name, last_name,phone_number, loyalty_program_id) VALUES (?, ?, ?,?, ?)");
    $req->execute([$user_id, $firstName, $lastName,$phoneNumber, $loyalty_program_id]);
}

function updateUser($userId, $email, $firstName, $lastName, $phoneNumber) {
    $db = getDatabase();
    $req = $db->prepare("UPDATE users SET email = ? WHERE user_id = ? "); 
    $req->execute([$email, $userId]);

    $req = $db->prepare("UPDATE clients SET first_name = ?, last_name = ?, phone_number = ? WHERE user_id = ? "); 
    $req->execute([$firstName, $lastName, $phoneNumber, $userId]);
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