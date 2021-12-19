<?php
include 'header.php';
if (isset($_SESSION['message'])){
    echo "<script>swal({title: '". $_SESSION['message'] ."', icon: '". $_SESSION['icon'] ."'})</script>";

    unset($_SESSION['message'], $_SESSION['icon']);
}
?>
<main>
    <div class="container h-100 my-2">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <form method="post" action="actions/register/user.php">

                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                                    <form class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="username">Your Username</label>
                                                <input type="text"
                                                       name="username"
                                                       class="form-control"
                                                       value="<?= $_SESSION['form_username'] ?? '' ?>"
                                                       required />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="email">Your Email</label>
                                                <input type="email"
                                                       name="email"
                                                       class="form-control"
                                                       value="<?= $_SESSION['form_email'] ?? '' ?>"
                                                       required />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="name">Your Name</label>
                                                <input type="text"
                                                       id="name"
                                                       name="name"
                                                       class="form-control"
                                                       value="<?= $_SESSION['form_name'] ?? '' ?>"
                                                       required />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input type="password"
                                                       name="password"
                                                       pattern=".{8,}"
                                                       title="Must contain at least 8 characters."
                                                       class="form-control"
                                                       required />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="no_tlp">Your Phone</label>
                                                <input type="number"
                                                       id="no_tlp"
                                                       name="phone_number"
                                                       class="form-control"
                                                       value="<?= $_SESSION['form_phone_number'] ?? '' ?>"
                                                       required />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="alamat_user">Your Address</label>
                                                <input type="text"
                                                       name="address"
                                                       value="<?= $_SESSION['form_address'] ?? '' ?>"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit"
                                                    name="submit"
                                                    class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="http://localhost/shiba-petshop/assets/img/register.png" class="img-fluid">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.title = "Register";
</script>
<?php
unset($_SESSION['form_username'],$_SESSION['form_name'],$_SESSION['form_email'],$_SESSION['form_phone_number'],$_SESSION['form_address']);
?>