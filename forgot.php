<?php
include 'header.php';

?>

<main class="card form-signin text-center my-6">
    <form action="<?php action('forgot/user.php');?>" method="post">
        <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>

        <div class="form-floating">
            <input type="email"
                   class="form-control"
                   id="floatingInput"
                   placeholder="your email"
                   name="forgot">
            <label class="label-login" for="floatingInput">your email</label>
        </div>
        
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="forgot">forget</button>
        <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
    </form>
</main>

<script>
    document.title = "forgot password";
</script>




