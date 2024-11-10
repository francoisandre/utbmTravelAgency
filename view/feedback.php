<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';

goToLoginIfNotConnected();
 
?>
<html>
<style>
        .star {
            color: gold;
        }
    </style>
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

    <select class="form-select" id="rating" name="rating">
            <option value="1" <?php if ($_SESSION['editedFeedback']['rating']==1) {echo 'selected';} ?>>★☆☆☆☆ (1)</option>
            <option value="2" <?php if ($_SESSION['editedFeedback']['rating']==2) {echo 'selected';} ?>>★★☆☆☆ (2)</option>
            <option value="3" <?php if ($_SESSION['editedFeedback']['rating']==3) {echo 'selected';} ?>>★★★☆☆ (3)</option>
            <option value="4" <?php if ($_SESSION['editedFeedback']['rating']==4) {echo 'selected';} ?>>★★★★☆ (4)</option>
            <option value="5" <?php if ($_SESSION['editedFeedback']['rating']==5) {echo 'selected';} ?>>★★★★★ (5)</option>
        </select>
        <label for="comments">Comments:</label>
        <textarea id="comments" class="form-control" name="comments" rows="10" required="required"><?php echo $_SESSION['editedFeedback']['comments']; ?></textarea><br/>

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
