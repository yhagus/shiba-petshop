<?php
include 'header.php';
?>
<main>
    <div class="container">
        <main>
            <!--            <div class="text-center">-->
            <!--                <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
            <!--                <h2>Checkout form</h2>-->
            <!--                <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>-->
            <!--            </div>-->

            <form class="row text-center py-4" method="post" action="actions/register/user.php">
                <div class="col-3"></div>
                <div class="col-6">
                    <h4 class="display-3">Register</h4>
                    <div class="row pt-4">
                        <div class="col-sm-12 pb-1">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control"
                                   id="name"
                                   placeholder="John Doe"
                                   name="name"
                                   required>
                            <div class="invalid-feedback">
                                Full name is required.
                            </div>
                        </div>

                        <div class="col-12 pb-1">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text"
                                       class="form-control"
                                       id="username"
                                       placeholder="Username"
                                       name="username"
                                       required>
                                <div class="invalid-feedback">
                                    Username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12 pb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                   class="form-control"
                                   pattern=".{8,}"
                                   title="Must contain at least 8 characters."
                                   id="password"
                                   name="password"
                                   required>
                            <div class="invalid-feedback">
                                Please enter your password.
                            </div>
                        </div>

                        <div class="col-12 pb-1">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="confirm_password"
                                   name="confirm_password"
                                   required>
                            <span id="message"></span>
                        </div>

                        <div class="col-12 pb-1">
                            <label for="address" class="form-label">Address</label>
                            <input type="text"
                                   class="form-control"
                                   id="address"
                                   placeholder="1234 Main St"
                                   name=""
                                   disabled>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="container text-end pt-4">
                            <button class="btn btn-primary"
                                    type="submit"
                                    name="submit">
                                Register
                            </button>
                        </div>
                    </div>
                    <div class="col-3"></div>
            </form>
        </main>
    </div>
</main>