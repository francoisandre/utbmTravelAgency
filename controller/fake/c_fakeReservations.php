<?php
include_once __DIR__.'/../../view/common/session.php';


include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';
include_once __DIR__.'/../../util/reservationUtils.php';

goToLoginIfNotAdmin();

if (!isset($_GET["email"])) {
    $_GET['errorMessage']="Email is mandatory";
    include __DIR__.'/../../view/clients.php';
    exit();
}

$client = getClientByEmail($_GET["email"]);

createReservation($client['client_id'], '2000-1-1');
createReservation($client['client_id'], '2030-1-1');

$_GET['successMessage']="Reservations have been created";
include __DIR__.'/../../view/clients.php';

?>
