<?php
include_once __DIR__.'/../../view/common/session.php';
function createClientIfNotExisting($email,$password,$firstName,$lastName,$phoneNumber) {
    if (!hasUserByEmail($email)) {
        createUser($email,$password,$firstName,$lastName,$phoneNumber, false);
    }
}

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

try {
    createClientIfNotExisting("john@beatles.com", "john", "John", "Lennon", "0100000000");
    createClientIfNotExisting("paul@beatles.com", "paul", "Paul", "McCartney", "0200000000");
    createClientIfNotExisting("george@beatles.com", "george", "George", "Harrison", "0300000000");
    createClientIfNotExisting("ringo@beatles.com", "ringo", "Ringo", "Starr", "0400000000");
}
catch (Exception $e) {
    $_GET['errorMessage']="An error has occurred";
    include __DIR__.'/../../view/clients.php';
    exit();
}
$_GET['successMessage']="Clients have been created";
    include __DIR__.'/../../view/clients.php';

?>
