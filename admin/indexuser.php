<?php
session_start();
require 'asset/functions.php';


if (isset($_SESSION['login'])) {
    if ($_SESSION['id_user'] == 1) {
        header('Location:index.php');
    }
} else {
    header('location:login.php');
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' and password='$password'");

    //mendapatkan hasil dari data
    $data = mysqli_fetch_assoc($query);
    // return var_dump($data);

    //mendapatkan nilai jumlah data
    $check = mysqli_num_rows($query);
    // return var_dump($check);

    if (!$check) {
        echo "<script>alert('Username atau password salah');location='login.php';</script>";
    } else {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['no_tlp'] = $data['no_tlp'];
        $_SESSION["login"] = true;

        header('location:indexuser.php');
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Page</title>
    <style>
        .card {
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
            width: 500px;
            margin-top: 50px;
            justify-content: center;
        }

        .button1 {
            padding: 7px 140px;
        }

        .center1 {
            margin-left: 70px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">

        <form method="POST" action="">
            <div class="card">
                <img src="asset/img/bg_login.png" width="100" height="400" class="card-img-top" alt="SnakeMan">
                <div class="card-body center1">
                    <h3>Login User</h3>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10 ">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10 ">
                            <button type="submit" class="btn btn-primary button1" name="loginuser">LOGIN</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>