<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */


if (isset($_POST)) 
{

	if(isset($_POST['update_profile']))
	{
		$id = $_SESSION['id'];
		$username = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone_number = $_POST['phone_number'];

		$query = "SELECT * FROM users WHERE username='$username' AND id_user !='$id' ";
		$result = mysqli_query($db, $query);
		$counts = mysqli_num_rows($result);

		if($counts==0)
		{

			$update = $db->query("UPDATE users SET username='$username',nama_user='$name',email='$email',alamat_user='$address',no_tlp='$phone_number' WHERE id_user='$id'") or die(mysqlI_error($db));


			if ($update)
			{
				echo "<script>alert('Update profile berhasil')</script>";
			} 
			else 
			{
				echo "<script>alert('Update profile gagal')</script>";
			}
		}
		else
		{	
			echo "<script>alert('username sudah digunakan')</script>";
			
		}

		echo "<script>location='../../user/profile.php'</script>";
	}
	// ubah foto
	elseif(isset($_POST['update_foto']))
	{
		$id = $_SESSION['id'];
		$result = $db->query("SELECT * FROM users WHERE id_user='$id'");
		$user = $result->fetch_assoc();
		$foto_lama = $user['foto_user'];
		$username = $user['username'];

		echo "<pre>";
		print_r ($_FILES['foto_user']);
		echo "</pre>";

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
			echo "<script>alert('Update foto berhasil')</script>";
		} 
		else 
		{
			echo "<script>alert('Update foto gagal')</script>";
		}
		echo "<script>location='../../user/profile.php'</script>";




	}
	elseif(isset($_POST['ubah_pass']))
	{

	}



} 
else 
{
	
	echo "<script>location='../../user/profile.php'</script>";
}
