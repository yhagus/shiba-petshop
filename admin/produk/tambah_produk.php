<?php
session_start();

if (isset($_SESSION['login'])) {
    if ($_SESSION['id_user'] > 1) {
        header('Location:../indexuser.php');
    }
} else {
    header('location:../login.php');
}


require '../asset/functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["tambah"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah_produk($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'produk.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'produk.php';
			</script>
		";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tambah</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">

    <link rel="stylesheet" href="../asset/css/admin.css">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>

</head>

<body>

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
            <!-- //sidenav -->

             <?php include "../sidemenu.php" ?>

            <main class="col-md-6 ms-sm-auto col-lg-10 px-md-4">
                <div class="bg-light p-2 rounded">
                    
                    <?php 
                    $kategori = query("SELECT * FROM kategori ");

                     ?>
                    <h1>Tambah Produk</h1><br>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-control form-select" name="id_kategori" required="">
                                    <option value="">-pilih-</option>
                                    <?php foreach ($kategori as $ktg): ?>
                                        
                                    <option value="<?php echo $ktg['id_kategori'] ?>"><?php echo $ktg['nama_kategori'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <!-- <input type="text" class="form-control" name="id_kategori" required> -->
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" name="harga_produk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Berat (gram)</label>
                                <input type="number" class="form-control" name="berat" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="5" cols="30" required=""></textarea>
                                <!-- <input type="text" class="form-control" name="deskripsi" required> -->
                            </div>
                            <div class="mb-3">
                                <label for="foto_produk">Foto Produk </label> <br>
                                <input type="file" name="foto_produk" id="foto_produk">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-dark" name="tambah">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </main>


            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
            <script src="../asset/js/admin.js"></script>
            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->



</body>

</html>