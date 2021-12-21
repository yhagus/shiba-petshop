<?php
include "header.php";
?>

<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-navbar">
    <div class="container-fluid">
        <a class="navbar-brand mx-3" href="#">SHIBA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" id="home" href="http://localhost/shiba-petshop">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="catalog" href="http://localhost/shiba-petshop/catalog.php">Catalog</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-3" type="search" placeholder="Search">
                <!--                <button class="btn btn-outline-success" type="submit">Search</button>-->
            </form>
            <?php
            if (isset($_SESSION['id'])){?>
                <div class="flex-shrink-0 dropdown mx-3">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow animate slideIn" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="http://localhost/shiba-petshop/user/cart.php"><i class="bi bi-cart me-2"></i>Shopping Cart</a></li>
                        <li><a class="dropdown-item" href="http://localhost/shiba-petshop/user/profile.php"><i class="bi bi-person me-2"></i>Manage Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="http://localhost/shiba-petshop/logout.php">Sign out</a></li>
                    </ul>
                </div>
            <?php
            } else{
            ?>
                <a class="nav-link me-3" href="login.php">Log in</a>
            <?php
            }
            ?>
        </div>
    </div>
</nav>
<br>    
<br>    