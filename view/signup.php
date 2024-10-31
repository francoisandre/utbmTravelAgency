<html>
<?php 
include 'common/header.php' 
?>
<?php 
$currentActiveMenu = "signup";
include 'common/menu.php' ?>

<h2>Veuillez-vous inscrire : </h2>
<form method="post" action="c_signup.php">

    <label for="First_name"  >Prénom :</label>
    <input id="First_name" class="form-control" name="First_name" type="text" required="required" placeholder="Antoine" /><br/>

    <label for="Name"  >Nom :</label>
    <input id="name" class="form-control" name="name" type="text" required="required" placeholder="Dupont" /><br/>

    <label for="phone"  >Téléphone  :</label>
    <input id="phone" class="form-control" name="phone" type="tel" required="required" placeholder="+33 6 12 34 56 78" /><br/>

    <label for="mail"  >Email :</label>
    <input id="mail" class="form-control" name="Email" type="text" required="required" placeholder="email@domain.com" /><br/>

    <label for="passwd">Mot de passe :</label>
    <input id="passwd"  class="form-control" name="passwd" type="password" required="required" placeholder="Entrez votre mot de passe" /><br/>

<!--   PAS UTILE  <label for="BD">Date de naissance:</label>-->
<!--    <input id="BD"  class="form-control" name="birth_date" type="date" value="bd" /><br/><br/>-->

    <div class="col-12">
        <button class="btn btn-primary" type="submit">S'inscrire</button>
    </div>

</form>

<?php 
include 'common/footer.php' 
?>
</body>
</html>
