<?php
session_start();
//cek login
if (isset($_SESSION['login'])) {
	if ($_SESSION['id_user'] > 1) {
		header('Location:indexuser.php');
	}
} else {
	header('location:login.php');
}

require 'asset/functions.php';


?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<title>Dashboard</title>

	<link rel="stylesheet" href="asset/css/admin.css">
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
			<a class="navbar-brand" href="index.php">Shiba Petshop</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
				</ul>
				<form class="d-flex">
					<a class="btn btn-outline-success" href="logout.php">Logout</a>
				</form>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			//sidenav
			<?php include 'sidemenu.php'; ?>

			//main
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<br><br>
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Welcome Admin </h1>
				</div>

				<div class="row">

					<div class="col-md-3">

						<a href="kategori/kategori.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>Kategori</h3>
							</div>
						</a>
					</div>	
					<div class="col-md-3">

						<a href="produk/produk.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>Produk</h3>
							</div>
						</a>
					</div>	
					<div class="col-md-3">

						<a href="transaksi/index.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>Transaksi</h3>
							</div>
						</a>
					</div>	
					<div class="col-md-3">

						<a href="blog/index.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>Blog</h3>
							</div>
						</a>
					</div>	
					<div class="col-md-3">

						<a href="user/user.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>User</h3>
							</div>
						</a>
					</div>	
					<div class="col-md-3">

						<a href="laporan/index.php" class="text-decoration-none text-black-50">

							<div class="card shadow-sm p-4 mb-4 text-center">
								<h3>Laporan</h3>
							</div>
						</a>
					</div>	

				</div>



				
				
			</main>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
	<script src="asset/js/admin.js"></script>
</body>

</html>