<?php
include_once __DIR__.'/common/session.php';

?>
<html lang="en">
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<body>
<?php 
$currentActiveMenu = "packageForm";
include_once __DIR__.'/common/menu.php';




goToLoginIfNotAdmin();
?>

<div class="container mt-2">
    <h2><?php echo ($_SESSION['packageEditionMode'] === "creation") ? "Create New Package" : "Edit Package"; ?></h2>

    <?php
    if (isset($_GET['errorMessage'])) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['errorMessage']) . "</div>";
    }

    if (isset($_GET['successMessage'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['successMessage']) . "</div>";
    }

    $packageName = $_SESSION['packageEditionMode'] === "modification" ? $_SESSION['editedPackage']['package_name'] : '';
    $destination = $_SESSION['packageEditionMode'] === "modification" ? $_SESSION['editedPackage']['destination'] : '';
    $price = $_SESSION['packageEditionMode'] === "modification" ? $_SESSION['editedPackage']['price'] : '';
    $duration = $_SESSION['packageEditionMode'] === "modification" ? $_SESSION['editedPackage']['duration'] : '';
    $itinerary = $_SESSION['packageEditionMode'] === "modification" ? $_SESSION['editedPackage']['itinerary'] : '';
    ?>
    <form method="post" action="<?php echo getBaseUrl()?>controller/packages/c_savePackages.php">
        <div class="form-group">
            <label for="packageName">Package Name</label>
            <input type="text" class="form-control" id="packageName" name="package_name" 
                   value="<?php echo htmlspecialchars($packageName); ?>" required>
        </div>

        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" 
                   value="<?php echo htmlspecialchars($destination); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" 
                   value="<?php echo htmlspecialchars($price); ?>" required>
        </div>

        <div class="form-group">
            <label for="duration">Duration (in days)</label>
            <input type="number" class="form-control" id="duration" name="duration" min="1" 
                   value="<?php echo htmlspecialchars($duration); ?>" required>
        </div>

        <div class="form-group">
            <label for="itinerary">Itinerary</label>
            <textarea class="form-control" id="itinerary" name="itinerary" rows="4" required><?php echo htmlspecialchars($itinerary); ?></textarea>
        </div>
        <div align="right">
        <button type="submit" class="btn btn-primary mt-2">
            <?php echo ($_SESSION['packageEditionMode'] === "creation") ? "Create Package" : "Update Package"; ?>
        </button>
</div>
    </form>
</div>

<?php include_once __DIR__.'/common/footer.php'; ?>
