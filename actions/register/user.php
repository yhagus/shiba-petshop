<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */
$username = stripslashes($_POST['username']);
$username = mysqli_real_escape_string($db, $username);
$name = stripslashes($_POST['name']);
$name = mysqli_real_escape_string($db, $name);
$email = stripslashes($_POST['email']);
$email = mysqli_real_escape_string($db, $email);
$password = stripslashes(md5($_POST['password']));
$password = mysqli_real_escape_string($db, $password);
$phone_number = stripslashes($_POST['phone_number']);
$phone_number = mysqli_real_escape_string($db, $phone_number);
$address = stripslashes($_POST['address']);
$address = mysqli_real_escape_string($db, $address);

$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($db, $query);
$counts = mysqli_num_rows($result);

if ($counts==1) {
    echo "<script>swal({title: 'Username sudah digunakan', icon: 'info'});</script>";
    header("location: ../../register.php");

} else {
//    INSERT TO DATABASE
    $query2 = "INSERT INTO users (username, email, password, nama_user, no_tlp, alamat_user, foto_user) VALUES ('$username', '$email', '$password', '$name', '$phone_number', '$address', '')";
    mysqli_query($db,$query2);

    echo "<script>swal({title: 'Berhasil daftar', icon: 'success'})</script>";

    header("location: ../../login.php");
}