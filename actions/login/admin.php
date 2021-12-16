<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($db, "SELECT * FROM users WHERE username='$username' and password='$password'");

    //mendapatkan hasil dari data
    $data = mysqli_fetch_assoc($query);
    // return var_dump($data);

    //mendapatkan nilai jumlah data
    $check = mysqli_num_rows($query);
    // return var_dump($check);

    if (!$check) {
        echo "<script>alert('Username atau password salah')</script>";
        header("location: ../../admin/login.php");
    } else {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['no_tlp'] = $data['no_tlp'];
        $_SESSION['login'] = true;
        $_SESSION['role'] = "superadmin";

        header('location:../../admin/index.php');
    }
}
