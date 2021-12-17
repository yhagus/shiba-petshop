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
    echo "<script>alert('Username sudah digunakan');location='../../register.php'</script>";

} else {
//    INSERT TO DATABASE
    $db->query("INSERT INTO `users` (username, email, password, nama_user, no_tlp, alamat_user, foto_user) VALUES ('$username', '$email', '$password', '$name', '$phone_number', '$address', '')");
//    var_dump($le);
    echo "<script>alert('Berhasil');location='../../register.php'</script>";
}