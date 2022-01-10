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
$detail=[];
$result = $conn->query("SELECT * FROM detail_transaksi  INNER JOIN produk ON detail_transaksi.id_produk = produk.id_produk WHERE id_transaksi='$id'
 ");
while ($data = $result->fetch_assoc()) {
    $detail[] = $data;
}

$result = $conn->query("SELECT * FROM pengiriman WHERE id_transaksi='$id' ");
$pengiriman = $result->fetch_assoc();

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
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../produk/produk.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="kategori.php">
                                <span data-feather="layers"></span>
                                Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="../user/user.php">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            //main
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <br><br>
                <h1 class="h2">Transaksi</h1><br>
                <div class="bg-light p-5 rounded">
                   <!--  <form class="d-flex" action="" method="POST">
                        <input class="form-control me-2" type="search" size="40" autofocus placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form><br><br> -->

                    <div class="accordion col-md-3" id="accordionExample">
                      <div class="accordion-item">
                        <h5 class="accordion-header" id="headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                             Filter transaksi
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; 
                $total_blj = 0;

                ?>
                <?php foreach ($detail as $transaksi) : ?>
                    <tr>
                        <td><?= $transaksi["produk"]; ?></td>
                        <td><?= rp($transaksi["harga"]); ?></td>
                        <td><?php echo $transaksi['jumlah'] ?></td>
                        <td><?= rp($transaksi["sub_total"]); ?></td>
                        <td></td>                       
                    </tr>
                    <?php $i++; ?>

                    <?php $total_blj += $transaksi['sub_total'] ?>
                <?php endforeach; ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th scope="col">Total Belanja</th>
                    <th><?php rp($total_blj) ?></th>
                </tr>
                <tr>
                <th></th>
                <th></th>
                    <th>Ongkir</th>
                    <th><?php echo rp($pengiriman['biaya_ongkir']) ?></th>
                </tr>
                <tr>
                <th></th>
                <th></th>
                    <th>Total Biaya</th>
                    <th><?php echo rp($pengiriman['biaya_ongkir'] + $total_blj) ?></th>
                </tr>

            </tbody>
        </table>

        <br><br>





    </div>
</main>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="../asset/js/admin.js"></script>
</body>

</html>