<?php
include 'header.php';
?>

<main class="form-signin text-center my-6">
    <form action="actions/login/user.php" method="post">
        <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text"
                   class="form-control"
                   id="floatingInput"
                   placeholder="username"
                   name="username">
            <label class="label-login" for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password"
                   class="form-control"
                   id="floatingPassword"
                   placeholder="password"
                   name="password">
            <label class="label-login" for="floatingPassword">Password</label>
        </div>

<!--        <div class="checkbox mb-3">-->
<!--            <label>-->
<!--                <input type="checkbox" value="remember-me"> Remember me-->
<!--            </label>-->
<!--        </div>-->
        <div>
            <p class="text-sm-start mx-1">No account? <a href="register.php" class="text-decoration-none" id="register">Create one!</a></p>
        </div>

<!--        <input type="submit" class="w-100 btn btn-lg btn-primary" value="Sign in">-->
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
    </form>
</main>
