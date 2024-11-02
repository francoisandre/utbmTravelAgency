<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Travel Agency Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="account.php">My account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="controller/c_logout.php">Logging off</a> 
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <p>Hi <?php echo $_SESSION['email'] ?>, welcome to your user area.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
