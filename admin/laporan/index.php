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

// pagination
// konfigurasi
// $jumlahDataPerHalaman = 10;
// $jumlahData = count(query("SELECT * FROM transaksi"));
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$transaksi = $conn->query("SELECT * FROM transaksi LEFT JOIN pengiriman ON transaksi.id_transaksi = pengiriman.id_transaksi ORDER BY transaksi.id_transaksi DESC  ") or die(mysqli_error($conn));



//search
if (isset($_POST["cari"])) {
    $transaksi = cari_transaksi($_POST["keyword"]);
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

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
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
                <h1 class="h2">Laporan Produk Terjual</h1><br>
                <div class="bg-light p-5 rounded">
                   <!--  <form class="d-flex" action="" method="POST">
                        <input class="form-control me-2" type="search" size="40" autofocus placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form><br><br> -->

                    <div class="accordion col-md-3" id="accordionExample">
                      <div class="accordion-item">
                        <h5 class="accordion-header" id="headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                             Filter laporan
                         </button>
                     </h5>
                     <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <form method="get" action="filter.php">
                            <div class="form-group mb-3">
                                <label><b>tgl awal</b></label>
                                <input type="date" name="tgl_awal" class="form-control" placeholder="tgl awal">
                            </div>
                            <div class="form-group mb-3">
                                <label><b>tgl akhir</b></label>
                                <input type="date" name="tgl_akhir" class="form-control" placeholder="tgl akhir">
                            </div>
                            <button class="btn btn-info">Filter</button>

                        </form>
                    </div>
                </div>
            </div>


        </div>



        <br>

        <?php 
        $terjual = [];
        $res = $conn->query("SELECT nama_produk , foto_produk, sum(jumlah) AS terjual FROM detail_transaksi RIGHT JOIN produk ON detail_transaksi.id_produk = produk.id_produk GROUP BY produk.id_produk ORDER BY terjual DESC");

        while ($data = $res->fetch_assoc()) {

            if(empty($data['terjual']))
            {
                $data['terjual'] = 0;
            }

            $terjual[] = $data;
        }


      

        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah Terjual</th>
                  
                           <!--      <th scope="col">Tgl Transaksi</th>
                           <th scope="col">Aksi</th> -->
                       </tr>
                   </thead>
                   <tbody>
                    <?php $i = 1; ?>
                   <?php foreach ($terjual as $data_terjual): ?>
                   <tr>
                       <td>
                           <img src="../../assets/img/produk/<?php echo $data_terjual['foto_produk'] ?>" width="80px">
                       </td>
                       <td><?php echo $data_terjual['nama_produk'] ?></td>
                       <td><?php echo $data_terjual['terjual'] ?></td>
                   </tr>
                   <?php endforeach ?>
                </tbody>
            </table>

            <br><br>
            <!--  -->

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