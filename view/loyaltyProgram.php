<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotAdmin();
 
?>
<html>
<?php 
include_once __DIR__.'/common/header.php' 
?>
<?php 
$currentActiveMenu = "profile";
include_once 'common/menu.php' ?>
<div class="container mt-4">
<h2>Loyalty program <?php echo $_SESSION['loyaltyProgramEditionMode'] ?>: </h2>

<form method="post" action="<?php echo getBaseUrl()?>controller/loyaltyProgram/c_saveLoyaltyProgram.php">

    <label for="programName"  >Program Name :</label>
    <input id="programName" class="form-control" name="programName" type="text" required="required" value="<?php echo $_SESSION['editedLoyaltyProgram']['programName'] ?>" /><br/>

    <label for="discountPercentage"  >Discount percentage :</label>
    <input id="discountPercentage" class="form-control" name="discountPercentage" type="text" required="required" value="<?php echo $_SESSION['editedLoyaltyProgram']['discountPercentage'] ?>" /><br/>

    <label for="requiredTripNumber"  >Required trips number  :</label>
    <input id="requiredTripNumber" <?php if ($_SESSION['editedLoyaltyProgram']['requiredTripNumber'] ==0 && $_SESSION['loyaltyProgramEditionMode'] =="edition") { echo "readonly";} ?>  class="form-control" name="requiredTripNumber" type="tel" required="required" value="<?php echo $_SESSION['editedLoyaltyProgram']['requiredTripNumber'] ?>" /><br/>

    <label for="colorCode"  >Colour code :</label>
    <input id="colorCode" class="form-control" name="colorCode" type="color" required="required" value="<?php echo $_SESSION['editedLoyaltyProgram']['colorCode'] ?>" /><br/>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>

</form>
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
