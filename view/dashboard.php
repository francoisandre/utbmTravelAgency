<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/userUtils.php';
include_once __DIR__.'/../util/reservationUtils.php';
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


<h4 class="mt-3"> Previous reservations </h4>

<?php 
$previousReservations = getCurrentUserPreviousReservations();

//$allReservations = getCurrentUserReservations();

if (count($previousReservations)==0) {
  echo "No planned reservations";
} else {

  ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>

  <?php

  //print_r($allReservations);

  foreach ($previousReservations as $index => $reservation) {
    echo("<tr><td>".($index+1)."</td><td>".explode(" ",$reservation['reservation_date'])[0]."</td></tr>");
  }
  ?>
</tbody>
</table>
<?php

}
?>
    <?php
    // Vérifie s'il y a des réservations précédentes ou non, puis affiche le bouton en-dessous du tableau
    ?>
    </tbody>
    </table>
    <?php
    // Check if there are previous reservations, then display the button below the table
    ?>
    </tbody>
    </table>
    <?php  ?>

    <!-- Button to add a new trip -->
    <div class="mt-3">
        <a href="add_trip.php" class="btn btn-primary">Add a New Trip</a>
    </div>



</div>




</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>

