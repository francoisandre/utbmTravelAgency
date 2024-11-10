<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';

goToLoginIfNotConnected();
 
?>
<html>
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<?php 
$currentActiveMenu = "dashboard";
include_once 'common/menu.php'; 
?>

<div class="container mt-4">
    <h2>Feedback <?php echo $_SESSION['feedbackEditionMode'] ?>: </h2>

    <!-- Formulaire pour l'édition ou la création de feedback -->
    <form method="post" action="<?php echo getBaseUrl()?>controller/feedback/c_saveFeedback.php">




        <label for="rating">Rating (1-5):</label>
        <input id="rating" class="form-control" name="rating" type="number" min="1" max="5" required="required" 
        value="<?php echo ($_SESSION['feedbackEditionMode'] == "edition") ? $_SESSION['editedFeedback']['rating'] : 0; ?>" /><br/>

        <label for="comments">Comments:</label>
        <textarea id="comments" class="form-control" name="comments" required="required"><?php echo ($_SESSION['feedbackEditionMode'] == "edition") ? $_SESSION['editedFeedback']['comments'] : ''; ?></textarea><br/>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">
                <?php echo ($_SESSION['feedbackEditionMode'] == "edition") ? "Update Feedback" : "Save Feedback"; ?>
            </button>
        </div>

    </form>
</div>

<?php 
include_once __DIR__.'/common/footer.php'; 
?>
</body>
</html>
