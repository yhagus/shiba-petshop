<?php
include 'navbar.php';

// query ambil data
$query = "SELECT * FROM produk";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($data = mysqli_fetch_assoc($result)) {
    $semua_data[] = $data;
}
// echo "<pre>";
// print_r ($semua_data);
// echo "</pre>";
?>

<div class="container mt-4-5">
    <div class="row">
        <?php foreach ($semua_data as $produk): ?>
            <?php
            $wishlist = '';
            if (isset($_SESSION['id'])) {
                $id_user = $_SESSION['id'];
                $id_produk = $produk['id_produk'];
                $result = $db->query("SELECT * FROM wishlist WHERE id_user='$id_user' AND id_produk='$id_produk'")->fetch_assoc();
                if ($result) $wishlist = $result['id_produk'];
            }
            ?>
            <div class="col-sm-6 col-md-3 mt-4-5">
                <div class="card p-3">
                    <!-- menampilkan image produk dari perulangan -->
                    <div class="row mx-auto">
                        <a href="detail.php?id=<?php echo $produk['id_produk'] ?>">
                            <img src="<?php asset('img/produk/' . $produk['foto_produk']);?>" class="card-img mb-3" height="200" alt="">
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-auto">
                            <!-- menampilkan nama produk dari perulangan produk -->
                            <a href="detail.php?id=<?php echo $produk['id_produk'] ?>" class="text-decoration-none">
                                <h3><?php echo $produk['nama_produk'] ?></h3>
                            </a>

                            <!-- menampilkan harga produk dari perulangan produk -->
                            <h5>Rp <?php echo $produk['harga_produk'] ?></h5>
                        </div>
                    </div>
                    <div class="row mt-4-5">
                        <div class="col-7 small">
                            <!-- link ke wishlist -->
                            <a href="<?php $produk['id_produk'] != $wishlist ? action('wishlist/add.php?id_produk=' . $produk['id_produk']) : action('wishlist/remove.php?id_produk=' . $produk['id_produk']);?>"
                               class="btn-sm btn-primary btn-product text-decoration-none">
                                <i class="bi <?= $produk['id_produk'] === $wishlist ? 'bi-heart-fill' : 'bi-heart' ?> me-1"></i>
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