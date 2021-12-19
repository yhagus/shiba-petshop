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

//if ($username === '' || $name === '' || $email === '' || $password === '' || $phone_number === '' || $address === ''){
//    $_SESSION['message'] = "Mohon isi dengan benar";
//    $_SESSION['icon'] = "success";
//    header("location:../../register.php");
//}

if ($counts==1) {
    $_SESSION['message'] = "Username sudah digunakan";
    $_SESSION['icon'] = 'info';

    $_SESSION['form_username'] = $username;
    $_SESSION['form_name'] = $name;
    $_SESSION['form_email'] = $email;
    $_SESSION['form_phone_number'] = $phone_number;
    $_SESSION['form_address'] = $address;

    header("location:../../register.php");

} else {
//    INSERT TO DATABASE
    $insert = mysqli_query($db,"INSERT INTO users (username, email, password, nama_user, no_tlp, alamat_user, foto_user) VALUES ('$username', '$email', '$password', '$name', '$phone_number', '$address', '')");
    if ($insert){
        header("location:../../login.php");
    } else {
        echo "<script>alert('Daftar gagal')</script>";
        header("location:../../register.php");
    }
//    echo "<script>swal({title: 'Berhasil', icon: 'success'})</script>";
}