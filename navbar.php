<?php
include "header.php";
$avatar = "";
$blank = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";
if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $user = $db->query("SELECT * FROM users WHERE id_user='$id'")->fetch_assoc();
    $avatar = "/shiba-petshop/assets/img/user/".$user['foto_user'];
}

?>

<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-navbar">
    <div class="container-fluid">
        <a class="navbar-brand mx-3" href="http://localhost/shiba-petshop/">SHIBA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" id="home" href="<?php route('/'); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="catalog" href="<?php route('catalog.php');?>">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="blog" href="<?php route('blog.php');?>">Blog</a>
                </li>

            </ul>
            <form action="<?php route('search.php');?>" method="get" class="d-flex">
                    <input class="form-control me-3" type="text" name="cari" placeholder="Search" >
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            <?php
            if (isset($_SESSION['id'])){?>
                <div class="flex-shrink-0 dropdown mx-3">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $user['foto_user'] === '' ? $blank : $avatar ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow animate slideIn" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="<?php route('user/riwayat.php');?>"><i class="bi bi-receipt-cutoff me-2"></i>History Transaction</a></li>
                        <li><a class="dropdown-item" href="<?php route('user/cart.php');?>"><i class="bi bi-cart me-2"></i>Shopping Cart</a></li>
                        <li><a class="dropdown-item" href="<?php route('user/wishlist.php');?>"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                        <li><a class="dropdown-item" href="<?php route('user/profile.php');?>"><i class="bi bi-person me-2"></i>Manage Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php route('logout.php');?>"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
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