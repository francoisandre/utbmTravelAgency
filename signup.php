<html>
<head>
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f;">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">Inscription : Travel Agency Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="signup.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Se connecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
