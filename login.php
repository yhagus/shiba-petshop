<?php
include 'header.php';
?>
<body class="user-login">
    <main class="form-signin text-center">
        <form>
            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="username">
                <label class="label-login" for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="password">
                <label class="label-login" for="floatingPassword">Password</label>
            </div>

    <!--        <div class="checkbox mb-3">-->
    <!--            <label>-->
    <!--                <input type="checkbox" value="remember-me"> Remember me-->
    <!--            </label>-->
    <!--        </div>-->

            <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>
    </main>
</body>

<?php
include 'footer.php';
?>
