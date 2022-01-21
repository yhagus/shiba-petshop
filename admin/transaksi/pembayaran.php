<?php
session_start();
//cek login
if (isset($_SESSION['login'])) {
    if ($_SESSION['id_user'] > 1) {
        header('Location:../indexuser.php');
    }
} else {
    header('location:../login.php');
}

require '../asset/functions.php';

$id = $_GET['id_transaksi'];

$result = $conn->query("SELECT * FROM transaksi INNER JOIN pembayaran ON transaksi.id_transaksi = pembayaran.id_transaksi WHERE pembayaran.id_transaksi='$id' ") or die(mysqli_error($conn));
$transaksi = $result->fetch_assoc(); 


if(is_null($transaksi))
{
    echo"<script>alert('user belum melakukan pembayaran');location='index.php'</script>";
    exit();
}
else
{


    $tgl_wkt = explode(" ", $transaksi['waktu_pembayaran']);
    $tgl = $tgl_wkt[0];
    $wkt = explode(":", $tgl_wkt[1]);
    $waktu = $wkt[0].":".$wkt[1];
}




?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../asset/css/admin.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }


        

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
          .modal-content {
            width: 100%;
        }
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>


<!-- Custom styles for this template -->
<link href="dashboard.css" rel="stylesheet">
</head>

<body>
    //nav
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Shiba Petshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-success" href="../logout.php">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            //sidenav
            <?php include "../sidemenu.php" ?>

            //main
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



                <br><br>
                <h1 class="h2">Pembayaran</h1><br>

                

                <div class="row mt-4">
                    <div class="col-1"></div>
                    <div class="col-7 text-start my-auto">


                        <p><span class="fw-bold">Invoice Date: </span><?= tanggal($transaksi['tgl_transaksi']); ?></p>
                        <p><span class="fw-bold">Invoice Code: </span><a href="detail.php?id_transaksi=<?php echo $transaksi['id_transaksi'] ?>" class=" text-decoration-none"><?= $transaksi['kode_transaksi']; ?></a></p>
                        <p><span class="fw-bold">Tagihan: </span><?= rp($transaksi['total_biaya']); ?></p>
                        <span><b>Status : </b></span>
                        <button
                        <?= $transaksi['status'] === 'selesai' ? 'class="btn rounded-pill btn-success"' : null;?>
                        <?= $transaksi['status'] === 'dikirim' ? 'class="btn rounded-pill btn-warning"' : null;?>
                        <?= $transaksi['status'] === 'diproses' ? 'class="btn rounded-pill btn-info text-white"' : null;?>
                        <?= $transaksi['status'] === 'belum bayar' ? 'class="btn rounded-pill btn-danger"' : null;?>
                        disabled
                        >
                        <?= $transaksi['status'] === 'selesai' ? 'Selesai' : null; ?>
                        <?= $transaksi['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                        <?= $transaksi['status'] === 'diproses' ? 'Menunggu Verifikasi' : null; ?>
                        <?= $transaksi['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                    </button>      
                    <br><br>
                    
                </div>
                <div class="col-3 text-start">
                    <img src="../../assets/img/bg_login.PNG" width="150" alt="" >

                </div>
            </div>
            <hr>
            <div class="card p-5 rounded">
                <div class="row mt-2">

                    <div class="col-md-4 text-start">
                        <span class="fw-bold">Bukti Transfer:</span>
                        <br><br>
                        <a href="#" class="zoom">

                            <img alt="Bukti Transfer" src="../../assets/img/bukti_transfer/<?php echo $transaksi['bukti_transfer'] ?>" class="img-fluid" onclick="document.getElementById('modal01').style.display='block'">
                        </a>

                    </div>
                    <div class="col-md-1">

                    </div>

                    <div class="col-md-4 ">
                        <span class="fw-bold">Verifikasi:</span>
                        <table class="table">
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?= tanggal($tgl); ?></td>

                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>: <?= $waktu; ?></td>
                            </tr>
                            <?php if ($transaksi['status']=="diproses"): ?>

                                <tr>
                                    <td>Opsi</td>
                                    <td>
                                        <form method="POST">
                                            : <button name="verifikasi" class="btn btn-success btn-sm" onclick="return confirm('verifikasi pembayaran ini?')">Verifikasi</button>
                                        </form>
                                        <?php 
                                        if(isset($_POST['verifikasi']))
                                        {


                                            $verif = 'terverifikasi';

                                            $conn->query("UPDATE transaksi SET status='$verif' WHERE id_transaksi='$id' ");
                                            echo"<script>alert('Pembayaran terverifikasi');location='index.php'</script>";
                                        }

                                        ?>
                                    </td>
                                </tr>

                                
                            <?php endif ?>


                        </table>

                        <!-- zoom modal -->
                        <div id="modal01" class="w3-modal py-xl-5" style="padding-top: 650px" onclick="this.style.display='none'">
                            <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                            <div class="w3-modal-content w3-animate-zoom" style="margin-top: 50px; margin-bottom: 50px;">
                              <img src="../../assets/img/bukti_transfer/<?php echo $transaksi['bukti_transfer'] ?>" style=" width: 100%;">
                          </div>
                      </div>
                  </div>
              </div>


          </div>



      </main>
  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="../asset/js/admin.js"></script>
<script src="../../assets/js/jquery-3.6.0.min.js"></script>


</body>

</html>