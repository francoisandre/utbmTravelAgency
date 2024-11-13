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

    // We duplicate fields with camel cased entries...
   $data["programName"] = $data["program_name"];
   $data["colorCode"] = $data["color_code"];
   $data["discountPercentage"] = $data["discount_percentage"];
   $data["requiredTripNumber"] = $data["required_trip_number"];

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

function recomputeClientLoyaltyProgram() {
    $clients = getClientsAndAdmins();
    for ($i = 0; $i < count($clients); $i++) {
       $client = $clients[$i];
       $numberOfReservations = count(getClientReservations($client['client_id']));
       $loyaltyProgramId =  getLoyaltyProgramIdFromTripNumber($numberOfReservations);
       updateLoyaltyProgramIdForClient($client['client_id'], $loyaltyProgramId);
    }
}
function recomputeCurrentUserLoyaltyProgram(){
$user=getCurrentUser();
$numberOfReservations = count(getClientReservations($user['client_id']));
       $loyaltyProgramId =  getLoyaltyProgramIdFromTripNumber($numberOfReservations);
       updateLoyaltyProgramIdForClient($user['client_id'], $loyaltyProgramId);
}

function deleteLoyaltyProgram($loyaltyProgramId) {
    $db = getDatabase();
    $req = $db->prepare("DELETE FROM loyaltyprograms WHERE loyalty_program_id = ?");
        $req->execute([$loyaltyProgramId    ]);
}

function updateLoyaltyProgram($loyaltyProgramId, $programName, $discountPercentage, $requiredTripNumber, $colorCode) {
    $db = getDatabase();
    $req = $db->prepare("UPDATE loyaltyprograms SET program_name = ?, discount_percentage = ?, required_trip_number = ?, color_code = ? WHERE loyalty_program_id = ? "); 
    $req->execute([$programName, $discountPercentage, $requiredTripNumber, $colorCode, $loyaltyProgramId]);
}

function getLoyaltyProgramByRequiredTripNumber($requiredTripNumber) {
    $db = getDatabase();
    $req = $db->prepare("SELECT * FROM loyaltyprograms WHERE required_trip_number = ?");
    $req->execute([$requiredTripNumber]);
    $data = $req->fetch();
    if ($data == false) {
        //No matching program
        return null;
    } else {
        return $data;
    }
}


function getLoyaltyPrograms() {
    $db = getDatabase();
    $req = $db->prepare("select * from loyaltyprograms order by required_trip_number ASC");
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
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