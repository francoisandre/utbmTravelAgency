<?php
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/reservationUtils.php';
goToLoginIfNotConnected();
?>
<html lang="en">
<?php include_once __DIR__.'/common/header.php'; ?>
<body>
<?php
$currentActiveMenu = "add_trip";
include_once __DIR__.'/common/menu.php';
?>
<div class="container mt-4">
    <h2>Ajouter un Nouveau Voyage</h2>

    <!-- Formulaire pour ajouter un voyage -->
    <form action="process_add_trip.php" method="POST">
        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" required>
        </div>
        <div class="form-group">
            <label for="start_date">Date de départ</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Date de retour</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <!-- Ajouter d'autres champs selon les besoins (type de package, hébergement, etc.) -->
        <button type="submit" class="btn btn-success mt-3">Save the Trip</button>
    </form>
</div>

<?php include_once __DIR__.'/common/footer.php'; ?>
</body>
</html>

