<?php 
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToDashboardIfConnected();
 
?>
<html>
<?php 
include_once __DIR__.'/common/header.php' 
?>
<?php 
$currentActiveMenu = "signup";
include_once 'common/menu.php' ?>
<div class="container mt-4">
<h2>Veuillez-vous inscrire : </h2>
<form method="post" action="<?php echo getBaseUrl()?>controller/c_signup.php">

    <label for="firstName"  >Prénom :</label>
    <input id="firstName" class="form-control" name="firstName" type="text" required="required" placeholder="Antoine" /><br/>

    <label for="lastName"  >Nom :</label>
    <input id="lastName" class="form-control" name="lastName" type="text" required="required" placeholder="Dupont" /><br/>

    <label for="phone"  >Téléphone  :</label>
    <input id="phone" class="form-control" name="phone" type="tel" required="required" placeholder="+33 6 12 34 56 78" /><br/>

    <label for="email"  >Email :</label>
    <input id="email" class="form-control" name="email" type="text" required="required" placeholder="email@domain.com" /><br/>

    <label for="passwd">Mot de passe :</label>
    <input id="passwd"  class="form-control" name="passwd" type="password" required="required" placeholder="Entrez votre mot de passe" /><br/>

<!--   PAS UTILE  <label for="BD">Date de naissance:</label>-->
<!--    <input id="BD"  class="form-control" name="birth_date" type="date" value="bd" /><br/><br/>-->

    <div class="col-12">
        <button class="btn btn-primary" type="submit">S'inscrire</button>
    </div>

</form>
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
