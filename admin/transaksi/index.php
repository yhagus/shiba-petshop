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
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM transaksi"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$transaksi = query("SELECT * FROM transaksi LEFT JOIN pengiriman ON transaksi.id_transaksi = pengiriman.id_transaksi LIMIT $awalData, $jumlahDataPerHalaman");

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
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Tgl Transaksi</th>
                    <th scope="col">Total</th>
                    <th scope="col">Resi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                           <!--      <th scope="col">Tgl Transaksi</th>
                           <th scope="col">Aksi</th> -->
                       </tr>
                   </thead>
                   <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($transaksi as $transaksi) : ?>
                        <tr>
                            <td><?= $transaksi["kode_transaksi"]; ?></td>
                            <td><?= tanggal($transaksi["tgl_transaksi"]); ?></td>
                            <td><?= rp($transaksi["total_biaya"]); ?></td>
                            <td><?= $transaksi["no_resi"]; ?></td>
                            <td>

                               <span
                               <?= $transaksi['status'] === 'selesai' ? 'class="badge rounded-pill bg-success"' : null;?>
                               <?= $transaksi['status'] === 'dikirim' ? 'class="badge rounded-pill bg-warning"' : null;?>
                               <?= $transaksi['status'] === 'terverifikasi' ? 'class="badge rounded-pill bg-primary"' : null;?>
                               <?= $transaksi['status'] === 'diproses' ? 'class="badge rounded-pill bg-info"' : null;?>
                               <?= $transaksi['status'] === 'belum bayar' ? 'class="badge rounded-pill bg-danger"' : null;?>
                               >
                               <?= $transaksi['status'] === 'selesai' ? 'Selesai' : null; ?>
                               <?= $transaksi['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                               <?= $transaksi['status'] === 'terverifikasi' ? 'Menunggu Pengiriman' : null; ?>
                               <?= $transaksi['status'] === 'diproses' ? 'Menunggu Verifikasi' : null; ?>
                               <?= $transaksi['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                           </span>

                       </td>
                       <td>
                        <a title="Detail" class="btn btn-outline-warning" href="detail.php?id_transaksi=<?= $transaksi["id_transaksi"]; ?>"><i class="bi bi-info"></i></a>
                        <a title="Pembayaran" class="btn btn-outline-success" href="pembayaran.php?id_transaksi=<?= $transaksi["id_transaksi"]; ?>" ><i class="bi bi-cash-coin"></i></a>

                        <?php if ($transaksi['status']=='terverifikasi' || $transaksi['status']=='dikirim'): ?>
                           <!--  <button data-bs-toggle="modal" data-bs-target="#resi" type="button"> resi</button> -->
                            <a title="Input Resi" class="btn btn-outline-primary resi" href="#" id_trans="<?php echo $transaksi['id_transaksi'] ?>" no_resi="<?php echo $transaksi['no_resi'] ?>" data-bs-toggle="modal"
                        data-bs-target="#resi" ><i class="bi bi-truck"></i></a>
                        <?php endif ?>

                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br><br>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($halamanAktif > 1) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>



    <div class="modal fade" id="resi" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModalLabel">Input No Resi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="post" action="">
                    <div class="form-group mb-4">
                    <div class="form-group">
                        <label>No Resi</label>
                        <input type="text" name="no_resi" class="form-control" required="" value="<?php echo $transaksi['no_resi'] ?>">
                    </div>
                        <input  name="id_trans" hidden="">
                    </div>
                    <button class="btn btn-success" name="input_resi">Input</button>
                </form>

                <?php 
                if(isset($_POST['input_resi']))
                {
                    

                    $resi = $_POST['no_resi'];
                    $id_trans = $_POST['id_trans'];
                    $dikirim = "dikirim";

                    $conn->query("UPDATE pengiriman SET no_resi='$resi' WHERE id_transaksi='$id_trans' ");
                    $conn->query("UPDATE transaksi SET status='$dikirim' WHERE id_transaksi='$id_trans' ");
                     echo"<script>alert('No Resi berhasil diinput');location='index.php'</script>";
                }

                 ?>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(".resi").on("click",function(){
            var id_trans = $(this).attr('id_trans');
            var no_resi = $(this).attr('no_resi');

           
            
            $("input[name=no_resi]").val(no_resi);
            $("input[name=id_trans]").val(id_trans);

        })
    })
</script>

</body>

</html>