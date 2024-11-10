<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';

goToLoginIfNotConnected();
 
?>
<html>
<?php 
include_once __DIR__.'/common/header.php' 
?>
<?php 
$currentActiveMenu = "dashboard";
include_once 'common/menu.php' ?>
<div class="container mt-4">
<h2>Feedback <?php echo $_SESSION['feedbackEditionMode'] ?>: </h2>
<!--
<form method="post" action="<?php echo getBaseUrl()?>controller/client/c_saveClient.php">

    <label for="firstName"  >First Name :</label>
    <input id="firstName" class="form-control" name="firstName" type="text" required="required" value="<?php echo $_SESSION['editedClient']['first_name'] ?>" /><br/>

    <label for="lastName"  >Last Name :</label>
    <input id="lastName" class="form-control" name="lastName" type="text" required="required" value="<?php echo $_SESSION['editedClient']['last_name'] ?>" /><br/>

    <label for="phone"  >Phone  :</label>
    <input id="phone" class="form-control" name="phone" type="tel" required="required" value="<?php echo $_SESSION['editedClient']['phone_number'] ?>" /><br/>

    <label for="email"  >Email :</label>
    <input id="email" class="form-control" name="email" type="text" required="required" value="<?php echo $_SESSION['editedClient']['email'] ?>" /><br/>

    <?php if ($_SESSION['clientEditionMode'] == "creation"): ?> 
        <label for="passwd"> Password :</label>
        <input id="passwd"  class="form-control" name="passwd" type="password" required="required" value="<?php echo $_SESSION['editedClient']['passwd'] ?>" /><br/>
    <?php endif; ?>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>

</form>-->
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
