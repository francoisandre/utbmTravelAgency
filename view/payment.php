<?php
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotConnected();

?>

<html>

<?php
include_once __DIR__.'/common/header.php'
?>

<body>
<?php
$currentActiveMenu = "profile";
include_once 'common/menu.php' ?>
<div class="container mt-4">




<!-- payment.php -->
<form action="/controller/c_payment.php" method="POST">
    <label for="id_booking">Booking ID:</label>
    <input type="text" class="form-control" id="id_booking" name="id_booking" required="required" placeholder="Enter your reservation number" ><br>

    <label for="amount">Amount:</label>
   <input type="number" id="amount" name="amount" required="required"><br>

    <label for="payment_method">Payment Method:</label>
    <select id="payment_method" class="form-control" name="payment_method" required>
        <option value="Credit Card">Credit Card</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Cash">Cash</option><br>
    </select>
<br>
    <div class="mt-3">
        <a href="/controller/c_payment.php" class="btn btn-primary">Submit Payment</a>
    </div>

</form>
</body>
    <?php
    include_once __DIR__.'/common/footer.php'
    ?>
</html>
