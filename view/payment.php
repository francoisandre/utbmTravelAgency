<?php
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotConnected();


$reservationId = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : '';
$db = getDatabase();
$req = $db->prepare("SELECT r.package_id, c.loyalty_program_id
                     FROM reservations r
                     JOIN clients c ON r.client_id = c.client_id
                     WHERE r.reservation_id = ?");
$req->execute([$reservationId]);
$reservation = $req->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    die("Réservation non trouvée");
}
$packageId = $reservation['package_id'];
$loyaltyProgramId = $reservation['loyalty_program_id'];
$reqPackage = $db->prepare("SELECT price FROM travelpackages WHERE package_id = ?");
$reqPackage->execute([$packageId]);
$package = $reqPackage->fetch(PDO::FETCH_ASSOC);

if (!$package) {
    die("Package non trouvé");
}

$price = $package['price'];
$reqLoyalty = $db->prepare("SELECT discount_percentage FROM loyaltyprograms WHERE loyalty_program_id = ?");
$reqLoyalty->execute([$loyaltyProgramId]);
$loyaltyProgram = $reqLoyalty->fetch(PDO::FETCH_ASSOC);

$discountPercentage = $loyaltyProgram ? $loyaltyProgram['discount_percentage'] : 0;
$discountAmount = ($price * $discountPercentage) / 100;
$finalAmount = $price - $discountAmount;

?>

<html>

<?php
include_once __DIR__.'/common/header.php';
?>

<body>
<?php
$currentActiveMenu = "profile";
include_once 'common/menu.php'; ?>
<div class="container mt-4">

    <form action="/controller/c_payment.php" method="POST">
        <label for="id_booking">Booking ID:</label>
        <input type="text" class="form-control" id="id_booking" name="id_booking" value="<?= htmlspecialchars($reservationId) ?>" required="required" readonly><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" class="form-control" min="1" name="amount" value="<?= htmlspecialchars($finalAmount) ?>" required="required" readonly><br>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" class="form-control" name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="Cash">Cash</option><br>
        </select>
        <br>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </div>
    </form>

</div>
</body>

<?php
include_once __DIR__.'/common/footer.php';
?>

</html>
