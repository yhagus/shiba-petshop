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
$jumlahData = count(query("SELECT * FROM blog"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$blog = query("SELECT * FROM blog LIMIT $awalData, $jumlahDataPerHalaman");



//search
// if (isset($_POST["cari"])) {
//     $blog = cari_blog($_POST["keyword"]);
// }

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
                <h1 class="h2">Blog</h1><br>
                <div class="bg-light p-5 rounded">
                    <!-- <form class="d-flex" action="search.php" method="POST">
                        <input class="form-control me-2" type="search" size="40" autofocus placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form><br><br> -->
                    <a class="btn btn-primary text-white" href="tambah_blog.php">Tambah Blog</a><br>
                    <br>

                  
                    <table class="table" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                
                                <th></th>
                                <th>Judul</th>
                                <th>Isi Blog</th>
                               
                                
                                <th width="171px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($blog as $row) : ?>
                                <tr>
                                  
                                    <td><img src="../../assets/img/blog/<?= $row["foto_blog"]; ?>" width="80" ></td>
                                    
                                    <td><?= $row["judul"]; ?></td>
                                    <td><?= cut_blog_desc($row["isi_blog"]); ?></td>
                                   
                                    <td>
                                    <a title="Detail Blog" class="btn btn-outline-info " href="detail_blog.php?id_blog=<?= $row["id_blog"]; ?>"><i class="bi bi-info"></i></a>
                                        <a title="Edit blog" class="btn btn-outline-warning " href="edit_blog.php?id_blog=<?= $row["id_blog"]; ?>"><i class="bi bi-pencil"></i></a>
                                        <a title="Hapus blog" class="btn btn-outline-danger" href="hapus_blog.php?id_blog=<?= $row["id_blog"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash"></i></a>
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