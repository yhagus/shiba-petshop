<?php
session_start();

if (isset($_SESSION['login'])) {
	if ($_SESSION['id_user'] > 1) {
		header('Location:indexuser.php');
	}
} else {
	header('location:login.php');
}

require 'asset/functions.php';

$branchNo = $_GET["branchNo"];

$branch = query("SELECT * FROM branch WHERE branchNO = $branchNo")[0];


if (isset($_POST["edit"])) {

	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
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


	<!-- Custom styles for this template -->
	<link href="navbar-top-fixed.css" rel="stylesheet">
</head>

<body>

	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">DreanHome</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah</a>
					</li>
				</ul>
				<form class="d-flex">
					<a class="btn btn-outline-success" href="login/logout.php">Logout</a>
				</form>
			</div>
		</div>
	</nav>

	<main class="container">
		<div class="bg-light p-5 rounded">
			<h1>Ubah branch</h1><br>
			<div class="card-body">
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $branch["id"]; ?>">
					<div class="mb-3">
						<label class="form-label">No Branch</label>
						<input type="text" class="form-control" name="branchNo" value="<?= $branch["branchNo"]; ?>">
					</div>
					<div class=" mb-3">
						<label class="form-label">Street</label>
						<input type="text" class="form-control" name="street" value="<?= $branch["street"]; ?>">
					</div>
					<div class="mb-3">
						<label class="form-label">City</label>
						<input type="text" class="form-control" name="city" value="<?= $branch["city"]; ?>">
					</div>
					<div class=" mb-3">
						<label class="form-label">postCode</label>
						<input type="number" class="form-control" name="postCode" value="<?= $branch["postCode"]; ?>">
					</div>
					<button type=" submit" class="btn btn-success" name="edit">Ubah Data</button>
				</form>
			</div>
		</div>
	</main>


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