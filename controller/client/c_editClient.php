<?php
include_once __DIR__.'/../../view/common/session.php';

include_once __DIR__.'/../../db/dbConnection.php';
include_once __DIR__.'/../../util/userUtils.php';

goToLoginIfNotAdmin();

if (!isset($_GET["email"])) {
    $_GET['errorMessage']="Email parameter is mandatory";
    include __DIR__.'/../../view/clients.php';
    exit();
    }

$_SESSION['clientEditionMode'] = "edition";
$_SESSION['editedClient'] = getClientByEmail($_GET["email"]);

include __DIR__.'/../../view/client.php';

?>
