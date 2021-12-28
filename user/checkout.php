<?php include '../navbar.php'; ?>
<?php include '../actions/ongkir/api.php'; ?>

<?php 
if (!isset($_SESSION['id'])) {
	header("location:/shiba-petshop/login.php");
	exit();
}
 ?>
<div class="container">

	<?php 


	$id = $_SESSION['id'];
	$result = $db->query("SELECT * FROM users WHERE id_user ='$id'");
	$user = $result->fetch_assoc();

	$id_keranjang = 1;
	$result = $db->query("SELECT * FROM keranjang INNER JOIN produk ON keranjang.id_produk=produk.id_produk INNER JOIN kategori ON kategori.id_kategori = produk.id_kategori ");

	while($data = $result->fetch_assoc())
	{
		$keranjang[] = $data;
	}

	// echo "<pre>";
	// print_r ($keranjang);
	// echo "</pre>";

	$total_berat=0;
	$total_belanja=0;
	foreach ($keranjang as $krj) 
	{
		$total_berat += $krj['berat']*$krj['jumlah'];
		$total_belanja += $krj['harga_produk']*$krj['jumlah'];
	}




	$prov = tampil_provinsi();


	?>
	<main>
		<div class="py-5 text-center">
			<img class="d-block mx-auto mb-4" src="/shiba-petshop/assets/img/checkout.png" alt="" width="150">
			<h2>Checkout form</h2>
		</div>
		<hr style="border-bottom: 2px dashed black; background: none">
		<br>
		<div class="row g-5">
			<div class="col-md-6 col-lg-4 order-md-last">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-primary">Your cart</span>
					<span class="badge bg-primary rounded-pill"><?php echo count($keranjang) ?></span>
				</h4>
				<ul class="list-group mb-3">
					<?php foreach ($keranjang as $krj): ?>
						
						<li class="list-group-item d-flex justify-content-between lh-sm">
							<div>
								<h6 class="my-0"><?php echo $krj['nama_produk'] ?></h6>
								<small class="text-muted"><?php echo $krj['nama_kategori'] ?></small>
							</div>
							<span class="text-muted"><?php rp($krj['harga_produk']) ?></span>
						</li>
					<?php endforeach ?>
					
					

					<li class="list-group-item d-flex justify-content-between bg-light">
						<div class="text-primary">
							<h6 class="my-0">Ongkir</h6>
							<span id="kurir"></span><span> - </span><span id="layanan"></span>
						</div>
						<span class="text-primary" id="biaya_ongkir">-</span>
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>Total Biaya</span>
						<strong id="total_biaya">-</strong>
					</li>
				</ul>

				
			</div>
			<div class="col-md-6 col-lg-8">
				<h4 class="mb-3">Penerima</h4>
				<form class="needs-validation" novalidate method="POST" action="../actions/transaction/save.php">
					<div class="row g-3">
						<div class="col-sm-12">
							<label for="firstName" class="form-label">Nama Penerima</label>
							<input type="text" class="form-control" id="firstName" placeholder=""  required name="nama_penerima">
							<div class="invalid-feedback">
								Valid first name is required.
							</div>
						</div>

						<div class="col-12">
							<label for="email" class="form-label">No Tlp / HP / WA</label>
							<input type="number" class="form-control" id="email" placeholder="nomor HP / WA" onkeydown="return event.keyCode !== 69" name="telp_penerima">
							<div class="invalid-feedback">
								Please enter a valid email address for shipping updates.
							</div>
						</div>

						<div class="col-12">
							<label for="address" class="form-label">Alamat Lengkap</label>
							<textarea class="form-control" cols="30" rows="5" name="alamat_tujuan"></textarea>	
							<div class="invalid-feedback">
								Please enter your shipping address.
							</div>
						</div>

						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="same-address" name="sama">
							<label class="form-check-label" for="same-address">Data penerima sama seperti profile</label>
						</div>


						<hr class="mt-5">
						<h4>Pengiriman</h4>
						<div class="col-md-4">
							<label for="country" class="form-label">Provinsi</label>
							<select class="form-select" id="provinsi" required name="provinsi">
								<option value="">-pilih-</option>
								<?php foreach ($prov as $prov): ?>

									<option value="<?php echo $prov['province_id'] ?>" prov_tujuan="<?php echo $prov['province'] ?>"><?php echo $prov['province'] ?></option>
								<?php endforeach ?>
							</select>

							<div class="invalid-feedback">
								Please select a valid country.
							</div>
						</div>

						<div class="col-md-4">
							<label for="state" class="form-label">Kota</label>
							<select class="form-select" id="state" required name="pilih_kota">
								
							</select>
							<div class="invalid-feedback">
								Please provide a valid state.
							</div>
						</div>

						<div class="col-md-3">
							<label for="zip" class="form-label">Kode Pos</label>
							<input type="text" class="form-control" id="zip" placeholder="" required>
							<div class="invalid-feedback">
								Zip code required.
							</div>
						</div>

						<div class="col-md-4">
							<label for="zip" class="form-label">Kurir</label>
							<select class="form-select" name="pilih_kurir">
							</select>
						</div>

						<div class="col-md-4">
							<label for="zip" class="form-label">Jenis Layanan</label>
							<select class="form-select" name="pilih_layanan">
							</select>
						</div>

						<div class="col-md-3">
							<label for="zip" class="form-label" >Biaya Ongkir</label>
							<input type="" class="form-control" name="tampil_ongkir" readonly="">
						</select>
					</div>

				</div>

				<hr class="my-4">
				<input type="" name="nama" value="<?php echo $user['nama_user'] ?>">
				<input type="" name="tlp" value="<?php echo $user['no_tlp'] ?>">
				<input type="" name="addr" value="<?php echo $user['alamat_user'] ?>">
				<br>
				<input type="" name="prov_tujuan" placeholder="prov_tujuan" >
				<input type="" name="kota_tujuan" placeholder="kota_tujuan" >
				<input type="" name="kurir" placeholder="kurir" >
				<input type="" name="layanan" placeholder="layanan" >
				<input type="" name="total_berat" placeholder="total_berat" value="<?php echo $total_berat ?>" >
				<input type="" name="total_belanja" placeholder="total_belanja" value="<?php echo $total_belanja ?>" >
				<input type="" name="ongkir" placeholder="ongkir" >
				<input type="" name="total_biaya" placeholder="total_biaya" >

				<br>
				<br>

				<hr class="my-4">

					<!-- <h4 class="mb-3">Payment</h4>

					<div class="my-3">
						<div class="form-check">
							<input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
							<label class="form-check-label" for="credit">Credit card</label>
						</div>
						<div class="form-check">
							<input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
							<label class="form-check-label" for="debit">Debit card</label>
						</div>
						<div class="form-check">
							<input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
							<label class="form-check-label" for="paypal">PayPal</label>
						</div>
					</div> -->

					<!-- <div class="row gy-3">
						<div class="col-md-6">
							<label for="cc-name" class="form-label">Name on card</label>
							<input type="text" class="form-control" id="cc-name" placeholder="" required>
							<small class="text-muted">Full name as displayed on card</small>
							<div class="invalid-feedback">
								Name on card is required
							</div>
						</div>

						<div class="col-md-6">
							<label for="cc-number" class="form-label">Credit card number</label>
							<input type="text" class="form-control" id="cc-number" placeholder="" required>
							<div class="invalid-feedback">
								Credit card number is required
							</div>
						</div>

						<div class="col-md-3">
							<label for="cc-expiration" class="form-label">Expiration</label>
							<input type="text" class="form-control" id="cc-expiration" placeholder="" required>
							<div class="invalid-feedback">
								Expiration date required
							</div>
						</div>

						<div class="col-md-3">
							<label for="cc-cvv" class="form-label">CVV</label>
							<input type="text" class="form-control" id="cc-cvv" placeholder="" required>
							<div class="invalid-feedback">
								Security code required
							</div>
						</div>
					</div> -->

					<hr class="my-4">

					<button class="w-100 btn btn-primary btn-lg" type="submit">Pesan Sekarang</button>
				</form>
			</div>
		</div>
	</main>

	<footer class="my-5 pt-5 text-muted text-center text-small">
		<p class="mb-1">&copy; 2017–2021 Company Name</p>
		<ul class="list-inline">
			<li class="list-inline-item"><a href="#">Privacy</a></li>
			<li class="list-inline-item"><a href="#">Terms</a></li>
			<li class="list-inline-item"><a href="#">Support</a></li>
		</ul>
	</footer>
</div>
