<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $res = mysqli_query($db, $query);

    if (mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);

        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("location: ../../index.php");

//        header();
    } else{
//        alert notification here, remove the var_dump()
        header("location: ../../login.php");
        var_dump('error');
        echo "<script></script>";
    }
}