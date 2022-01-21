<?php
include '../navbar.php';

// query ambil data
$id = $_SESSION['id'];
$query = "SELECT wl.*, p.* FROM wishlist wl INNER JOIN produk p ON wl.id_produk=p.id_produk WHERE id_user='$id'";
$result = $db->query($query);
while ($data = mysqli_fetch_assoc($result)) {
    $semua_data[] = $data;
}
// echo "<pre>";
// print_r ($semua_data);
// echo "</pre>";
?>

<div class="container mt-4-5">
    <div class="row">
        <div class="col text-end">
            <div>
                <a href="<?php route('/');?>" class="text-decoration-none">Home</a> > Wishlist
            </div>
        </div>
    </div>
    <?php
    if (mysqli_num_rows($result) < 1){ ?>
        <div class="row text-center">
            <h1 class="display-1">Tidak punya wishlist</h1>
        </div>
    <?php
    } else {
    ?>
    <div class="row">
        <?php foreach ($semua_data as $produk): ?>
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
                        <div class="col-7"></div>
                        <!-- link ke keranjang -->
                        <div class="col-5 small text-end">
                            <a href="../detail.php?id=<?php echo $produk['id_produk'] ?>"
                               class="btn-sm btn-success btn-product text-decoration-none">
                                <i class="bi bi-cart me-1"></i>
                                Buy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
        }
        ?>

    </div>
</div>

<script>
    document.title = "Wishlist";
</script>