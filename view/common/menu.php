<?php 
include_once __DIR__.'/../../util/pathUtils.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f;">

    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo getBaseUrl() ?>">Travel Agency Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (!isset($_SESSION['email'])){ ?>  

                <li class="nav-item">
                    <a class="nav-link <?php if ($currentActiveMenu != 'signup') echo 'active'; ?> " aria-current="page" href="<?php echo getBaseUrl()?>view/signup.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentActiveMenu != 'login') echo 'active'; ?>" href="<?php echo getBaseUrl()?>view/login.php">Se connecter</a>
                </li>
                <?php } else { ?>
                    <li class="nav-item">
                    <a class="nav-link <?php if ($currentActiveMenu != 'login') echo 'active'; ?>" href="<?php echo getBaseUrl()?>controller/c_logout.php">Se déconnecter</a>
                </li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<?php 
if (isset($_GET["errorMessage"])) { ?>
<div class="alert alert-danger" role="alert">
   <?php echo $_GET["errorMessage"] ?> 
</div>
<?php }
?> 

<?php 
if (isset($_GET["successMessage"])) { ?>
<div class="alert alert-success" role="alert">
   <?php echo $_GET["successMessage"] ?> 
</div>
<?php }
?> 
