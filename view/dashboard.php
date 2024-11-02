<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/userUtils.php';
goToLoginIfNotConnected();
?>
<html lang="en">
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
  <h1 class="display-4">Welcome <?php echo getCurrentUserName() ?> !</h1>
  <div class="p-3 bg-light border rounded">
  <h4 class="display-6"> <i style="font-size: 72px;vertical-align: middle;color:<?php echo getCurrentUser()["color_code"]?>"   class="material-icons">emoji_events</i> Loyalty program: <?php echo getCurrentUser()['program_name'] ?></h4>
  <h5 class="display-7"><?php 
  $neededTripNumber = getCurrentUserTripNumberToNextLoyaltyProgram();
  if ($neededTripNumber == 0) {
    echo "You have reached the maximum loyalty program";
  } else {
    echo "You need ".$neededTripNumber." more reservation(s) to reach the next loyalty program";
  }
   ?></h5>
</div>
</div>




</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
