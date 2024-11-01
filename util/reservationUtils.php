<?php 
include_once __DIR__."/../db/dbConnection.php";
include_once __DIR__."/../util/userUtils.php";

function getCurrentUserReservations() {
    $user = getCurrentUser();
    $db = getDatabase();
    $req = $db->prepare("SELECT COUNT(*) AS TOTAL FROM reservations WHERE client_id = ?");
    $req->execute([$user['client_id']]);
    $data = $req->fetch();
   return $data['TOTAL'];
}

?>