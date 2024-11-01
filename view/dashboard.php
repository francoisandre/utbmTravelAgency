<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/userUtils.php';
goToLoginIfNotConnected();
?>
<html lang="fr">
<?php 
include_once __DIR__.'/common/header.php' 
?>
<body>
<?php
$currentActiveMenu = "";
include_once __DIR__.'/common/menu.php' 
?>
<div class="container mt-4">
<h2>Dashboard :</h2>

<div class="jumbotron">
  <h1 class="display-4">Bienvenue <?php echo getUserNameByEmail($_SESSION['email']) ?> !</h1>
</div>
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
