<?php
include '../../config.php';

$username = $_POST['forgot'];


$query = "SELECT * FROM users WHERE email='$email' ";

$res = mysqli_query($db, $query);

if (mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);


    header("location: ../../forgot-password.php");
} else{
    echo "<script>alert('Email Tidak Terdaftar');location='../../forgot.php'</script>";
}
?>