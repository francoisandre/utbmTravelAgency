<?php 
include_once __DIR__."/../db/dbConnection.php";

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


?>