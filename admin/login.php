<?php
include '../header.php';
?>

<main>
    <div class="container mt-4-5">
        <form method="POST" action="../actions/login/admin.php">
            <div class="row">
                <div class="col-2 col-md-4"></div>
                <div class="col-8 col-md-4">
                    <div class="card">
                        <img src="/shiba-petshop/assets/img/bg_login.png" height="300" class="card-img-top" alt="SnakeMan">
                        <div class="card-body">
                            <h3 class="text-center">Login Superadmin</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Username" name="username">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-md-4"></div>
            </div>
        </form>

    </div>
</main>

<script>
    document.title = "Login Superadmin";
</script>
