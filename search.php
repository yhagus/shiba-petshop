<?php
include 'navbar.php';


$keyword = $_GET['cari'];
$semua_data=[];
$result = $db->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' ");
while($data = $result->fetch_assoc())
{
    $semua_data[] = $data;
}

?>

<div class="container mt-4-5">
    <div class="row">
    <?php if (empty($semua_data)): ?>
        <?php echo "<script>alert('Barang Tidak Ditemukan');location='catalog.php'</script>"; ?>
    <?php endif ?>
        <?php foreach ($semua_data as $produk): ?>
            <div class="col-sm-6 col-md-3 mt-4-5">
                <div class="card p-3">
                    <!-- menampilkan image produk dari perulangan -->
                    <div class="row mx-auto">
                        <a href="detail.php?id=<?php echo $produk['id_produk'] ?>">
                            <img src="assets/img/produk/<?php echo $produk['foto_produk'] ?>" class="card-img mb-3" height="200">
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-auto">
                            <!-- menampilkan nama produk dari perulangan produk -->
                            <a href="detail.php?id=<?php echo $produk['id_produk'] ?>" class="text-decoration-none">
                                <h3><?php echo $produk['nama_produk'] ?></h3>
                            </a>

                            <!-- menampilkan harga produk dari perulangan produk -->
                            <h5>Rp. <?php echo $produk['harga_produk'] ?></h5>

                            <h5>deskripsi : <br><h6> <?php echo $produk['deskripsi'] ?></h6></h5>
                        </div>
                    </div>
                    <div class="row mt-4-5">
                        <div class="col-7 small">
                            <!-- link ke wishlist -->
                            <a href="wishlist.php?id=<?php echo $produk['id_produk'] ?>"
                               class="btn-sm btn-primary btn-product text-decoration-none">
                                <i class="bi bi-heart me-1"></i>
                                Wishlist
                            </a>
                        </div>
                        <!-- link ke keranjang -->
                        <div class="col-5 small text-end">
                            <a href="beli.php?id=<?php echo $produk['id_produk'] ?>"
                               class="btn-sm btn-success btn-product text-decoration-none">
                                <i class="bi bi-cart me-1"></i>
                                Buy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>

<script>
    document.title = "Catalog Product";
    document.getElementById("catalog").classList.add("active");
</script>