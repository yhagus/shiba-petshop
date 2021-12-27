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

	if(isset($_POST['update_profile']))
	{
		$username = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone_number = $_POST['phone_number'];

        $result = $db->query("SELECT * FROM users WHERE username='$username' AND id_user !='$id' ");
        $counts = mysqli_num_rows($result);

		if($counts==0)
		{
			$update = $db->query("UPDATE users SET username='$username',nama_user='$name',email='$email',alamat_user='$address',no_tlp='$phone_number' WHERE id_user='$id'") or die(mysqlI_error($db));
			if ($update)
			{
                $_SESSION['swal'] = [
                    "icon" => "success",
                    "title" => "Berhasil update data"
                ];
//				echo "<script>alert('Update profile berhasil')</script>";
			} 
			else 
			{
                $_SESSION['swal'] = [
                    "icon" => "error",
                    "title" => "Gagal update data"
                ];
//				echo "<script>alert('Update profile gagal')</script>";
			}
		}
		else
		{
            $_SESSION['swal'] = [
                "icon" => "info",
                "title" => "Username sudah digunakan"
            ];
//			echo "<script>alert('username sudah digunakan')</script>";
		}
	}
	// ubah foto
	elseif(isset($_POST['update_foto']) )
	{

		if(!empty($_FILES['foto_user']['name']))
		{
			$result = $db->query("SELECT * FROM users WHERE id_user='$id'");
			$user = $result->fetch_assoc();
			$foto_lama = $user['foto_user'];
			$username = $user['username'];

			$img_name = $_FILES['foto_user']['name'];
			$tmp_img = $_FILES['foto_user']['tmp_name'];
			$rename_img = $username."_".$img_name;

			if($foto_lama !== "default.png")
			{
				if(file_exists("../../assets/img/user/".$foto_lama))
				{
					unlink("../../assets/img/user/".$foto_lama);
				}
			}

			move_uploaded_file($tmp_img, "../../assets/img/user/$rename_img");

			$update = $db->query("UPDATE users SET foto_user='$rename_img' WHERE id_user='$id'") or die(mysqlI_error($db));
			if ($update)
			{
                $_SESSION['swal'] = [
                    "icon" => "success",
                    "title" => "Foto berhasil diubah"
                ];
//				echo "<script>alert('Update foto berhasil')</script>";
			} 
			else
			{
                $_SESSION['swal'] = [
                    "icon" => "error",
                    "title" => "Foto gagal diubah"
                ];
//				echo "<script>alert('Update foto gagal')</script>";
			}
		}
	}
	elseif(isset($_POST['ubah_pass']))
	{
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $result = $db->query("SELECT * FROM users WHERE id_user='$id'");
        $user = $result->fetch_assoc();

        if ($old_password != $user['password']){
            $_SESSION['swal'] = [
                "icon" => "error",
                "title" => "Password lama salah"
            ];
//            echo "<script>alert('Password lama salah!')</script>";
        } else {

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
        }
	}
//    echo "<script>location='../../user/profile.php'</script>";
} 
else 
{
    header("location: ../../user/profile.php");
//	echo "<script>location='../../user/profile.php'</script>";
}
header("location: ../../user/profile.php");
