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
    <div class="row">
       
        <div class="col-12 col-md-8 d-flex justify-content-start mb-3" style="margin-top: 30px;">
            <h1 class="display-4">Welcome <?php echo getCurrentUserName() ?>!</h1>
        </div>

       
        <div class="col-12 col-md-4" style="margin-top: 20px;">
            <div id="loyalty-program" class="p-3 bg-light border rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4 class="display-6" style="font-size: 18px;"> 
                    <i style="font-size: 50px;vertical-align: middle;color:<?php echo getCurrentUser()["color_code"]?>" class="material-icons">emoji_events</i> 
                    Loyalty program: <?php echo getCurrentUser()['program_name'] ?>
                </h4>
                <h5 class="display-7" style="font-size: 14px;"><?php 
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

    <div class="row">
        <div class="col-12 col-md-8">
        <div class="mt-3">
    <a href="<?= getBaseUrl() ?>view/add_trip.php" class="btn btn-primary">Add a New Trip</a>
</div>

            <h4 class="mt-3">Future reservations</h4>
            <?php 
            $futureReservations = getCurrentUserFutureReservations();
            if (count($futureReservations) == 0) {
                echo "No upcoming reservations";
            } else {
            ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($futureReservations as $index => $reservation) {
                        $reservationDate = isset($reservation['reservation_date']) ? $reservation['reservation_date'] : 'N/A';
                        echo("<tr><td>".($index+1)."</td><td>".explode(" ",$reservationDate)[0]."</td></tr>");
                    }
                    ?>
                </tbody>
            </table>
            <?php } ?>
        </div>

        <div class="col-12 col-md-8" style="margin-top: 30px;">
            <h4 class="mt-3">Previous reservations</h4>
            <?php 
            $previousReservations = getCurrentUserPreviousReservations();
            if (count($previousReservations) == 0) {
                echo "No planned reservations";
            } else {
            ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($previousReservations as $index => $reservation) {
                        $reservationDate = isset($reservation['reservation_date']) ? $reservation['reservation_date'] : 'N/A';
                        $reservationId = $reservation['reservation_id']; 
                        echo("<td>".($index+1)."</td>");
                        echo("<td>".explode(" ",$reservationDate)[0]."</td>");
                    echo("<td>");
                    if ($reservation["feedback_id"] == null){
                        echo("<a href='".getBaseUrl()."controller/feedback/c_newFeedback.php?reservationId=".$reservationId."' class='btn btn-primary'>Add Feedback</a>");
                    }else{
                        echo("<a href='view/feedback_form.php?reservation_id=".$reservation['reservation_id']."' class='btn btn-primary'>Edit Feedback</a>");
                    }
                        echo("</td>");
                        echo("</tr>");
                    }
                    ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>

<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
