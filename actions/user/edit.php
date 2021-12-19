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
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];

$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($db, $query);
$counts = mysqli_num_rows($result);

$update = mysqli_query($db,"UPDATE users SET username='$username',nama_user='$name',email='$email',alamat_user='$address',no_tlp='$phone_number' WHERE id_user='$id'");

var_dump($db->error);

if ($update){
    echo "<script>alert('Ubah berhasil')</script>";
} else {
    echo "<script>alert('Ubah gagal')</script>";
}
header("location:../../user/profile.php");