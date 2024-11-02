<?php 
include_once __DIR__.'/common/session.php'; 
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotAdmin();

?>
<html lang="en">
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<body>
<?php 
$currentActiveMenu = "accommodations";
include_once __DIR__.'/common/menu.php' ;
?>
<div class="container mt-4">
<h2>Accommodations List :</h2>


</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
