<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$res = mysqli_query($db, $query);

if (mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);

    $_SESSION['id'] = $row['id_user'];
//    $_SESSION['role'] = $row['role'];

    header("location: ../../index.php");
} else{
    header("location: ../../login.php");
}