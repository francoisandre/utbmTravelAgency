<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f;">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">Inscription : Travel Agency Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentActiveMenu != 'signup') echo 'active'; ?> " aria-current="page" href="signup.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentActiveMenu != 'login') echo 'active'; ?>" href="login.php">Se connecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
