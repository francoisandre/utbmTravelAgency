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
  <h1 class="display-4">Bienvenue <?php echo getCurrentUserName() ?> !</h1>
  <div class="p-3 bg-light border rounded">
  <h4 class="display-6"> <i style="font-size: 72px;vertical-align: middle;color:<?php echo getCurrentUser()["color_code"]?>"   class="material-icons">emoji_events</i> Programme de fidélité: <?php echo getCurrentUser()['program_name'] ?></h4>
</div>
</div>




</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
