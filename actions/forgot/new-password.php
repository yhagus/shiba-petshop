<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */

include '../../header.php';

/*
 * METHODS
 */

$email = $_SESSION['email'];

if(isset($_POST['ubah_pass']))
{
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    if($new_password==$confirm_password)
    {
        $db->query("UPDATE users SET password = '$new_password' WHERE email='$email'");
        echo "<script>alert('password berhasil diubah');location='../../login.php'</script>";
    }
    else
    {
        echo "<script>alert('password dan konfirmasi tidak cocok');location='new-password.php'</script>";
    }

}
?>
<main class="card form-signin text-center my-6">
    <form method="post">
        <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">New Password</h1>

        <div class="form-floating">
        <input type="password" name="new_password" class="form-control rounded-4"
                        placeholder="new password">
                <label for="">New Password</label>
        </div>

        <div class="form-floating">
                <input type="password" name="confirm_password"
                        class="form-control rounded-4" placeholder="confirm new password">
                <label for="">Confirm New Password</label>
        </div>

        <div class="form-floating">
                <button class="w-100 mb-2 btn btn-lg rounded-4 btn-dark" name="ubah_pass"
                    type="submit">Save Changes
                </button>
        </div>

        <br>
        
    </form>
</main>

<script>
    document.title = "forgot password";
</script>