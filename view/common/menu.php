<?php 
include_once __DIR__.'/../../util/pathUtils.php';
include_once __DIR__.'/../../util/userUtils.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo getBaseUrl() ?>">Travel Agency Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (!isLogged()): ?>  
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentActiveMenu != 'signup') echo 'active'; ?>" aria-current="page" href="<?php echo getBaseUrl()?>view/signup.php">Sign up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentActiveMenu != 'login') echo 'active'; ?>" href="<?php echo getBaseUrl()?>view/login.php">Log In</a>
                    </li>
                <?php else: ?>
                    <?php if (isAdmin()): ?> 
                        
                        <li class="nav-item">
                            <a class="nav-link <?php if ($currentActiveMenu != 'clients') echo 'active'; ?>" href="<?php echo getBaseUrl()?>view/clients.php">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($currentActiveMenu != 'packages') echo 'active'; ?>" href="<?php echo getBaseUrl()?>view/packages.php">Packages</a> <!-- Modifié ici -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($currentActiveMenu != 'loyaltyPrograms') echo 'active'; ?>" href="<?php echo getBaseUrl()?>view/loyaltyPrograms.php">Loyalty Programs</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentActiveMenu != 'profile') echo 'active'; ?>" href="<?php echo getBaseUrl()?>controller/client/c_editProfile.php">My profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentActiveMenu != 'login') echo 'active'; ?>" href="<?php echo getBaseUrl()?>controller/c_logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (isset($_GET["errorMessage"])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_GET["errorMessage"] ?> 
    </div>
<?php } ?> 

<?php if (isset($_GET["successMessage"])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET["successMessage"] ?> 
    </div>
<?php } ?> 
