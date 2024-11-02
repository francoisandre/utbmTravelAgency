<?php 
include_once __DIR__.'/common/session.php'; 
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToDashboardIfConnected();

?>
<html lang="en">
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<body>
<?php 
$currentActiveMenu = "login";
include_once __DIR__.'/common/menu.php' ;
?>
<div class="container mt-4">
<h2>Log in to your account:</h2>

<form method="post" action="<?php echo getBaseUrl()?>controller/c_login.php">

    <label for="email"  >Email :</label>
    <input id="email" class="form-control" name="email" type="text" required="required" placeholder="email@domain.com" /><br/>

    <label for="passwd">Mot de passe :</label>
    <input id="passwd"  class="form-control" name="passwd" type="password" required="required" placeholder="Enter your password" /><br/>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Log in</button>
    </div>
</form>
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
