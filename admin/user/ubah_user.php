<?php
session_start();

if (isset($_SESSION['login'])) {
	if ($_SESSION['id_user'] > 1) {
		header('../Location:indexuser.php');
	}
} else {
	header('location:../login.php');
}

require '../asset/functions.php';

$id_user = $_GET["id_user"];

$users = query("SELECT * FROM users WHERE id_user = $id_user")[0];


if (isset($_POST["edit"])) {

	if (ubah_user($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'user.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'user.php';
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
	<title>ubah</title>

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
							<a class="nav-link" href="../transaksi/index.php">
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
							<a class="nav-link" href="../kategori/kategori.php">
								<span data-feather="layers"></span>
								Category
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="user.php">
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

			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<div class="bg-light p-5 rounded">
					<h1>Ubah User</h1><br>
					<div class="card-body">
						<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id_user" value="<?= $users["id_user"]; ?>">
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input type="text" class="form-control" name="username" value="<?= $users["username"]; ?>">
							</div>
							<div class=" mb-3">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" name="email" value="<?= $users["email"]; ?>">
							</div>
							<div class="mb-3">
								<label class="form-label">Password</label>
								<input type="text" class="form-control" name="password" value="<?= $users["password"]; ?>">
							</div>
							<div class=" mb-3">
								<label class="form-label">Nama</label>
								<input type="text" class="form-control" name="nama_user" value="<?= $users["nama_user"]; ?>">
							</div>
							<div class=" mb-3">
								<label class="form-label">No Tlp</label>
								<input type="number" class="form-control" name="no_tlp" value="<?= $users["no_tlp"]; ?>">
							</div>
							<div class=" mb-3">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control" name="alamat_user" value="<?= $users["alamat_user"]; ?>">
							</div>
							<button type=" submit" class="btn btn-success" name="edit">Ubah Data</button>
						</form>
					</div>
				</div>
			</main>


			<!-- Optional JavaScript; choose one of the two! -->
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