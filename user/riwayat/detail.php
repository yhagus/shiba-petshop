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
$user_id = $transaksi['id_user'];

if($id_user !== $user_id)
{
    echo "<script>alert('Hayoo jangan ngintip belanjaan user lain yaa');location='../riwayat.php'</script>";
    exit();

}

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
                            <p><span class="fw-bold">Invoice Date: </span><?= tanggal($transaksi['tgl_transaksi']); ?></p>
                            <p><span class="fw-bold">Invoice Code: </span><?= $kode_transaksi; ?></p>
                            <span><b>Status : </b></span>
                            <button
                            <?= $transaksi['status'] === 'selesai' ? 'class="btn rounded-pill btn-success"' : null;?>
                            <?= $transaksi['status'] === 'dikirim' ? 'class="btn rounded-pill btn-warning"' : null;?>
                            <?= $transaksi['status'] === 'terverifikasi' ? 'class="btn btn-sm rounded-pill btn-primary"' : null;?>
                            <?= $transaksi['status'] === 'diproses' ? 'class="btn rounded-pill btn-info text-white"' : null;?>
                            <?= $transaksi['status'] === 'belum bayar' ? 'class="btn rounded-pill btn-danger"' : null;?>
                            disabled
                            >
                            <?= $transaksi['status'] === 'selesai' ? 'Selesai' : null; ?>
                            <?= $transaksi['status'] === 'dikirim' ? 'Sedang dikirim' : null; ?>
                            <?= $transaksi['status'] === 'terverifikasi' ? 'Pembayaran Terverifikasi' : null; ?>
                            <?= $transaksi['status'] === 'diproses' ? 'Diproses' : null; ?>
                            <?= $transaksi['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                        </button>
                        <br><br>
                        <?php
                        if ($transaksi['status'] === 'belum bayar'){?>
                        <button type="button" title="Upload Bukti Transfer" class="btn btn-sm btn-outline-dark rounded-pill"  data-bs-toggle="modal"
                        data-bs-target="#upload_bukti">
                        Upload Bukti Transfer <i class="ms-2 bi bi-upload"></i>
                    </button>
                    <?php } ?>

               <!--  <?php if ($transaksi['status'] === 'dikirim' || $transaksi['status'] === 'selesai'): ?>
                    Resi : <?php echo $transaksi['no_resi'] ?>
                <?php endif ?> -->
            </div>
        </div>

        <hr class="mx-6">

        <div class="row mt-2">
            <div class="col-md-1"></div>
            <div class="col-md-5 text-start">

                <span class="fw-bold">Penerima:</span>
                <table class="table">
                    <tr>
                        <td>Penerima</td>
                        <td>: <?= $pengiriman['nama_penerima']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $pengiriman['alamat_tujuan']; ?></td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>: <?= $pengiriman['kota_tujuan']; ?></td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>: <?= $pengiriman['telp_penerima']; ?></td>
                    </tr>

                </table>

            </div>
            <div class="col-md-1"></div>

            <div class="col-md-4 ">
                <span class="fw-bold">Ekspedisi:</span>
                <table class="table">
                    <tr>
                        <td>Kurir</td>
                        <td>: <?= $pengiriman['kurir']; ?></td>
                    </tr>
                    <tr>
                        <td>Service</td>
                        <td>: <?= $pengiriman['service']; ?></td>
                    </tr>
                    <tr>
                        <td>Resi</td>
                        <td>: <?= $pengiriman['no_resi']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <br><br>

        <div class="row">
            <div class="col-md-10 col-11 mx-auto">

                <table class="table mt-2 border">
                    <thead>
                        <tr class="table-info">
                            <th></th>
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
                            <td>
                                <img src="../../assets/img/produk/<?php echo $product['foto_produk'] ?>" class="img-fluid" width="120">
                            </td>
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
        <div class="col-2 text-end"><b><?php echo rp($sum['total'] + $pengiriman['biaya_ongkir']) ?></b></div>
    </div>

    <hr class="mx-6">

</div>
</div>
</div>

<div class="modal fade" id="upload_bukti" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModalLabel">Upload Bukti Transfer kamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row mb-4">
                    <div class="col-12 col-md-6 mx-auto text-center shadow-lg rounded-sm py-2 px-2">
                        <img src="https://my.jagoweb.com/images/bank_logo/logo_bca.png" class="img-fluid" alt="">
                        <div class="text-center">

                            <p>Silakan Transfer Ke <b>Bank BCA</b></p>
                            <p>No Rekening <b>190257894125</b></p>
                            <p>a/n. <b>Bagus Pranowo</b></p>
                            <p >Jumlah Tagihan Anda : </p>
                            <p><b><?php echo rp($transaksi['total_biaya']) ?></b></p>
                        </div>
                    </div>

                </div>
                <form method="post" enctype="multipart/form-data" action="<?php action('../actions/transaction/payment.php');?>">
                    <div class="form-group mb-4">
                        <input type="file" name="bukti_transfer">
                        <input hidden="" name="id_transaksi" value="<?php echo $id_transaksi ?>">
                    </div>
                    
                    <button class="btn btn-success" name="upload_bukti_transfer">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</main>

<script>
    document.title = "<?= $_GET['kode'] ?>";
</script>

<!-- <script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/pickadate/lib/picker.date.js"></script>
<script src="../../assets/js/pickadate/lib/picker.time.js"></script>
<script type="text/javascript">
    $('.datepicker').pickadate()
</script> -->