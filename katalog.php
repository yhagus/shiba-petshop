<?php 
include 'navbar.php'; 

include 'database.php';

// query ambil data
$query = "SELECT * FROM produk";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($data = $result->fetch_assoc()) {
	$semua_data[] = $data; 
}

// echo "<pre>";
// print_r ($semua_data);
// echo "</pre>";
?>



<div class="container" style="margin-top: 120px;">
    <div class="row">
    	<?php foreach ($semua_data as $produk): ?>

				<div class="col-sm-3 col-md-3">
				<div class="card p-3" >
					
					<!-- menampilkan image produk dari perulangan -->
					<div class="text-center">
						<a href="detail_produk.php?id=<?php echo $produk['id_produk'] ?>">
						
					<img src="assets/img/<?php echo $produk['foto_produk'] ?>" class="img-responsive mb-3" height="250px" >
					</a>
					</div>
					<div class="caption">
						<div class="row">
							<div class="col-6">
							<!-- menampilkan nama produk dari perulangan produk -->
								<a href="detail_produk.php?id=<?php echo $produk['id_produk'] ?>">
									<h3><?php echo $produk['nama_produk'] ?></h3>
								</a>
								
							<!-- menampilkan harga produk dari perulangan produk -->
								<h3><label>Rp <?php echo $produk['harga_produk'] ?></label></h3>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col">
							<!-- link ke wishlist -->
								<a href="wishlist.php?id=<?php echo $produk['id_produk'] ?>" class="btn btn-primary btn-product"><i class="bi bi-heart"></i> 	 Wishlist</a> 
							</div>
							<!-- link ke keranjang -->
							<div class="col text-end">
								<a href="beli.php?id=<?php echo $produk['id_produk'] ?>" class="btn btn-success btn-product"><i class="bi bi-cart"></i> Beli</a></div>
						</div>

						<p> </p>
					</div>
				</div>
			</div>
				
			<?php endforeach ?> 

	</div>
</div>