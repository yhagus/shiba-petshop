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
            <?php include "../sidemenu.php" ?>

            //main
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



                <br><br>
                <h1 class="h2">Detail Transaksi</h1><br>

                <?php $result = $conn->query("SELECT * FROM transaksi WHERE id_transaksi='$id' ");
                $transaksi = $result->fetch_assoc(); 


                ?>

                <div class="row mt-4">
                    <div class="col-1"></div>
                    <div class="col-7 text-start my-auto">
                        <img src="../../assets/img/bg_login.PNG" width="150" alt="">
                    </div>
                    <div class="col-3 text-start">
                        <p><span class="fw-bold">Invoice Date: </span><?= tanggal($transaksi['tgl_transaksi']); ?></p>
                        <p><span class="fw-bold">Invoice Code: </span><?= $transaksi['kode_transaksi']; ?></p>
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
                        <?= $transaksi['status'] === 'diproses' ? 'Diproses' : null; ?>
                        <?= $transaksi['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                    </button>      
                    <br><br>
                    

                    <?php if ($transaksi['status'] === 'dikirim' || $transaksi['status'] === 'selesai'): ?>
                        Resi : 
                    <?php endif ?>
                </div>
            </div>
            <hr>
            <div class="card p-5 rounded">
                <div class="row mt-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-5 text-start">

                        <span class="fw-bold">Penerima:</span>
                        <table class="table">
                            <tr>
                                <td>Penerima</td>
                                <td>: <?= $pengiriman['nama_penerima']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?= $pengiriman['alamat_tujuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Kota</td>
                                <td>: <?= $pengiriman['kota_tujuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>: <?= $pengiriman['telp_penerima']; ?></td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-4 ">
                        <span class="fw-bold">Ekspedisi:</span>
                        <table class="table">
                            <tr>
                                <td>Kurir</td>
                                <td>: <?= $pengiriman['kurir']; ?></td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td>: <?= $pengiriman['service']; ?></td>
                            </tr>
                            <tr>
                                <td>Resi</td>
                                <td>: <?= $pengiriman['no_resi']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <br><br><hr><br><br>
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