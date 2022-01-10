<?php

include "../../navbar.php";

if (!isset($_SESSION['id'])) {
    header("location:../index.php");
}

$id_user = $_SESSION['id'];
$kode_transaksi = $_GET['kode'];

// table transaksi
$transaksi = $db->query("SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'")->fetch_assoc();
$id_transaksi = $transaksi['id_transaksi'];

// table detail join produk
$detail = $db->query("SELECT detail_transaksi.*, produk.* FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk WHERE id_transaksi='$id_transaksi'");

// table user
$user = $db->query("SELECT * FROM users WHERE id_user='$id_user'")->fetch_assoc();

// menjumlahkan subtotal
$sum = $db->query("SELECT SUM(sub_total) AS total FROM detail_transaksi WHERE id_transaksi='$id_transaksi'")->fetch_assoc();

$products = [];

while ($data = $detail->fetch_assoc()){
    $products[] = $data;
}


$pengiriman = $db->query("SELECT * FROM pengiriman WHERE id_transaksi='$id_transaksi' ")->fetch_assoc();

?>
<main class="mt-4-5">
    <div class="container">
        <div class="row">
            <div class="col mb-2">
                <h6 class="display-6">Invoice <?= $kode_transaksi; ?></h6>
            </div>
            <div class="col text-end">
                <div>
                    <a href="<?php route('/');?>" class="text-decoration-none">Home</a> > <a href="<?php route('user/riwayat.php');?>" class="text-decoration-none">Riwayat</a> > Invoice
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 col-md-10 mx-auto">
                <div class="card">
                    <div class="row mt-4">
                        <div class="col-1"></div>
                        <div class="col-7 text-start my-auto">
                            <img src="<?php asset('img/bg_login.PNG');?>" width="150" alt="">
                        </div>
                        <div class="col-3 text-start">
                            <p><span class="fw-bold">Invoice Date: </span><?= $transaksi['tgl_transaksi']; ?></p>
                            <p><span class="fw-bold">Invoice: </span><?= $kode_transaksi; ?></p>
                            <button
                                <?= $transaksi['status'] === 'selesai' ? 'class="btn rounded-pill btn-success"' : null;?>
                                <?= $transaksi['status'] === 'dikirim' ? 'class="btn rounded-pill btn-warning"' : null;?>
                                <?= $transaksi['status'] === 'diproses' ? 'class="btn rounded-pill btn-info"' : null;?>
                                <?= $transaksi['status'] === 'belum bayar' ? 'class="btn rounded-pill btn-danger"' : null;?>
                                disabled
                            >
                                <?= $transaksi['status'] === 'selesai' ? 'Selesai' : null; ?>
                                <?= $transaksi['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                                <?= $transaksi['status'] === 'diproses' ? 'Diproses' : null; ?>
                                <?= $transaksi['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                            </button>
                        </div>
                    </div>

                    <hr class="mx-6">

                    <div class="row mt-2">
                        <div class="col-1"></div>
                        <div class="col-7 text-start">
                            <span class="fw-bold">Invoiced to:</span>
                            <p><?= $user['nama_user']; ?></p>
                            <p><?= $user['alamat_user']; ?></p>
                            <p><?= $user['no_tlp']; ?></p>
                        </div>
                        <div class="col-4 text-center">
<!--                            Pay to:-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-11 mx-auto">
                            <table class="table mt-2 border">
                                <thead>
                                <tr class="table-info">
                                    <th>Item</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-end">Jumlah</th>
                                    <th class="text-end">Harga </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td colspan="6"><?= $product['produk']; ?></td>
                                    <td class="text-end"><?= $product['jumlah']; ?> x</td>
                                    <td class="text-end"><?= rp($product['harga']); ?></td>
                                </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1"></div>
                        <div class="col-8 text-end fw-bold">Sub Total</div>
                        <div class="col-2 text-end"><?= rp($sum['total']); ?></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1"></div>
                        <div class="col-8 text-end fw-bold">Ongkir</div>
                        <div class="col-2 text-end"><?php echo rp($pengiriman['biaya_ongkir']) ?></div>
                    </div>

                    <br>

                    <div class="row mt-2 mb-3">
                        <div class="col-1"></div>
                        <div class="col-8 text-end fw-bold">Total</div>
                        <div class="col-2 text-end"><?php echo rp($sum['total'] + $pengiriman['biaya_ongkir']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.title = "<?= $_GET['kode'] ?>";
</script>