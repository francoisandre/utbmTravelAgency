<?php
include_once __DIR__.'/common/session.php'; 
include_once __DIR__.'/../util/packageUtils.php';
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotAdmin();

$packages = getAllPackages();
?>

<html lang="en">
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<body>
<?php 
$currentActiveMenu = "packages";
include_once __DIR__.'/common/menu.php';
?>
<div class="container mt-3">
    <h2>List of Packages</h2>

    <?php if (count($packages) == 0) { ?>
        <p>No packages available</p>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Package Name</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Duration (days)</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($packages as $index => $package) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($package['package_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($package['destination']) . "</td>";
                    echo "<td>" . htmlspecialchars($package['duration']) . "</td>";
                    echo "<td>" . htmlspecialchars($package['price']) . "</td>";
                    echo "<td>";
                    // Modifier les liens pour envoyer packageId dans l'URL
                    echo "<a href='".getBaseUrl()."controller/packages/c_editPackages.php?packageId=".$package['package_id']."' style='cursor:pointer'><i title='Edit' class='material-icons' style='color: green;'>edit</i></a>&nbsp;";
                    echo "<a href='".getBaseUrl()."controller/packages/c_deletePackages.php?packageId=".$package['package_id']."' onclick='return confirmDelete();' style='cursor:pointer'><i title='Delete' class='material-icons' style='color: red;'>delete</i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php } ?>

    <div class="text-end">
        <form style="display: inline-block;" method="post" action="<?php echo getBaseUrl()?>controller/packages/c_newPackages.php">
            <button class="btn btn-primary" type="submit">Add New Package</button>
        </form>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Do you confirm this action?");
}
</script>

<?php 
include_once __DIR__.'/common/footer.php';
?>
</body>
</html>
