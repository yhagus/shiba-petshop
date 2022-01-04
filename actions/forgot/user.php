<?php
include '../../config.php';

$email = $_POST['forgot'];

$_SESSION['email'] = $email;

$query = "SELECT * FROM users WHERE email='$email' ";

$res = mysqli_query($db, $query);

if (mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);


    header("location: new-password.php");
}  else{
    echo "<script>alert('Email Tidak Terdaftar');location='../../forgot.php'</script>";
}
?>