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
<?php 
$currentActiveMenu = "profile";
include_once 'common/menu.php' ?>
<div class="container mt-4">
<h2>Client Edition: </h2>

<form method="post" action="<?php echo getBaseUrl()?>controller/client/c_saveClient.php">

    <label for="firstName"  >First Name :</label>
    <input id="firstName" class="form-control" name="firstName" type="text" required="required" value="<?php echo $_SESSION['editedClient']['first_name'] ?>" /><br/>

    <label for="lastName"  >Last Name :</label>
    <input id="lastName" class="form-control" name="lastName" type="text" required="required" value="<?php echo $_SESSION['editedClient']['last_name'] ?>" /><br/>

    <label for="phone"  >Phone  :</label>
    <input id="phone" class="form-control" name="phone" type="tel" required="required" value="<?php echo $_SESSION['editedClient']['phone_number'] ?>" /><br/>

    <label for="email"  >Email :</label>
    <input id="email" class="form-control" name="email" type="text" required="required" value="<?php echo $_SESSION['editedClient']['email'] ?>" /><br/>

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
