<?php 
include_once __DIR__."/../db/dbConnection.php";
include_once __DIR__."/../util/userUtils.php";

function createLoyaltyProgram($programName, $discountPercentage, $requiredTripNumber, $colorCode) {
    $db = getDatabase();
    $req = $db->prepare("INSERT INTO loyaltyprograms (program_name, discount_percentage, required_trip_number, color_code) VALUES (?, ?, ?, ?)"); 
    $req->execute([$programName, $discountPercentage, $requiredTripNumber, $colorCode]);
}

function getLoyaltyProgramIdFromTripNumber($numberOfTrip) {
    $db = getDatabase();
    $req = $db->prepare("SELECT loyalty_program_id FROM loyaltyprograms WHERE required_trip_number <= ? ORDER BY required_trip_number DESC");
    $req->execute([$numberOfTrip]);
    $data = $req->fetch();
    return $data['loyalty_program_id'];
}

function getLoyaltyProgramFromId($id) {
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM loyaltyprograms WHERE loyalty_program_id = ?");
    $req->execute([$id]);
    $data = $req->fetch();
    return $data;
}

function getNextLoyaltyProgram($currentProgram) {
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM loyaltyprograms WHERE required_trip_number > ? ORDER BY required_trip_number ASC");
    $req->execute([$currentProgram['required_trip_number']]);
    $data = $req->fetch();
    if ($data == false) {
        //Maximum program reached
        return null;
    } else {
        return $data;
    }
}

function getCurrentUserTripNumberToNextLoyaltyProgram() {
    $user = getCurrentUser();
    $loyaltyProgram = getLoyaltyProgramFromId($user['loyalty_program_id']);
    $nextLoyaltyProgram = getNextLoyaltyProgram($loyaltyProgram);
    if ($nextLoyaltyProgram == null) {
        return 0;
    } else {
        $numberOfReservation = count(getCurrentUserReservations());
        return $nextLoyaltyProgram["required_trip_number"] - $numberOfReservation; 
    }
    
}


?>