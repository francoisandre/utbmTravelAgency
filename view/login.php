<html lang="fr">
<?php 
include 'common/header.php' 
?>
<body>
<?php 
$currentActiveMenu = "login";
include 'common/menu.php' 
?>

<h2>Connectez vous à votre compte :</h2>

<?php 
if (isset($_GET["errorCode"])) { ?>
<div class="alert alert-danger" role="alert">
  A simple danger alert—check it out!
</div>
<?php }
?> 

<form method="post" action="c_login.php">

    <label for="mail"  >Email :</label>
    <input id="email" class="form-control" name="email" type="text" required="required" placeholder="email@domain.com" /><br/>

    <label for="passwd">Mot de passe :</label>
    <input id="passwd"  class="form-control" name="passwd" type="password" required="required" placeholder="Entrez votre mot de passe" /><br/>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>
</form>

<?php 
include 'common/footer.php' 
?>
</body>
</html>
