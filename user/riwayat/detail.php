<?php

include "../../navbar.php";

if (!isset($_SESSION['id'])) {
    header("location:../index.php");
}

$kode_transaksi = $_GET['kode'];

$transaksi = $db->query("SELECT id_transaksi FROM transaksi WHERE kode_transaksi='$kode_transaksi'")->fetch_assoc();
$id_transaksi = $transaksi['id_transaksi'];

$detail = $db->query("SELECT detail_transaksi.*, produk.* FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk WHERE id_transaksi='$id_transaksi'");

$sum = $db->query("SELECT SUM(sub_total) AS total FROM detail_transaksi WHERE id_transaksi='$id_transaksi'")->fetch_assoc();

$products = [];
while ($data = $detail->fetch_assoc()) {
    $products[] = $data;
}

?>
<main class="mt-4-5">
    <div class="container">
        <div class="row">
            <a href="/shiba-petshop/user/riwayat.php">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
        <div class="row">
            <?php
            foreach ($products as $product) {
                ?>
                <div class="col-9 mb-3 mx-auto">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-2 m-auto text-center">
                                    <img class="img-fluid" width="75"
                                         src="/shiba-petshop/assets/img/produk/<?= $product['foto_produk'] ?>" alt="">
                                </div>
                                <div class="col-12 col-lg-10">
                                    <h5 class="card-title fs-2"><?= $product['produk']; ?></h5>
                                    <div class="row">
                                        <div class="col text-start">
                                            <p class="card-text fs-6">Quantity: <?= $product['jumlah']; ?></p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="card-text fs-6">@<?= $product['harga']; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="card-text text-end fs-5"><?= $product['sub_total']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-9 mx-auto">
                <hr>
                <div class="row fs-3">
                    <div class="col">Subtotal:</div>
                    <div class="col text-end"><?= $sum['total']; ?></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.title = "<?= $_GET['kode'] ?>";
</script>