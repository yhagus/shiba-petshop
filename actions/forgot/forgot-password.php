<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */


$id = $_SESSION['id'];

if (isset($_POST)) 
{
		
	if(isset($_POST['ubah_pass']))
	{
        
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $result = $db->query("SELECT * FROM users WHERE id_user='$id'");
        $user = $result->fetch_assoc();

            if ($new_password == $confirm_password){

                $update = $db->query("UPDATE users SET password='$new_password'");

                if ($update){
                    $_SESSION['swal'] = [
                        "icon" => "success",
                        "title" => "Password berhasil diubah"
                    ];
//                    echo "<script>alert('Update password berhasil!')</script>";
                } else{
                    $_SESSION['swal'] = [
                        "icon" => "success",
                        "title" => "Password gagal diubah"
                    ];
//                    echo "<script>alert('Update password gagal')</script>";
                }
            }
            else {
                $_SESSION['swal'] = [
                    "icon" => "error",
                    "title" => "Konfirmasi password salah"
                ];
//                echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
            }
        
	
//    echo "<script>location='../../user/profile.php'</script>";
 
else 
{
    header("location: ../../login.php");
//	echo "<script>location='../../user/profile.php'</script>";
}
header("location: ../../forgot.php");

?>
<main class="card form-signin text-center my-6">
    <form action="<?php action('forgot-password.php');?>" method="post">
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
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="ubah_pass">forget</button>
        <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
    </form>
</main>

<script>
    document.title = "forgot password";
</script>