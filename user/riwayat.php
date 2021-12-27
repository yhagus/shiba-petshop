<?php

include "../navbar.php";
if (!isset($_SESSION['id'])) {
    header("location:../index.php");
}

$id = $_SESSION['id'];
$result = $db->query("SELECT * FROM transaksi WHERE id_user=1");
$transactions = [];
while ($data = mysqli_fetch_assoc($result)){
    $transactions[] = $data;
}

?>
<main class="mt-4-5">
    <div class="container">
        <div class="row">
            <?php
            foreach ($transactions as $transaction) {
                ?>
                <div class="col-7 mb-3 mx-auto">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-4 m-auto text-center">
                                    <img class="img-fluid" width="150"
                                         src="/shiba-petshop/assets/img/statement.png" alt="">
                                </div>
                                <div class="col-12 col-lg-8">
                                    <h5 class="card-title"><?= $transaction['kode_transaksi']; ?></h5>
                                    <p class="card-text"><?= tanggal($transaction['tgl_transaksi']); ?></p>
                                    <p class="card-text">Rp. <?= $transaction['total_biaya']; ?></p>
                                    <p class="card-text">
                                        <span
                                            <?= $transaction['status'] === 'belum bayar' ? 'class="border border-danger text-danger rounded-3 p-1 px-2"' : null; ?>
                                            <?= $transaction['status'] === 'diproses' ? 'class="border border-info text-info rounded-3 p-1 px-2"' : null; ?>
                                            <?= $transaction['status'] === 'dikirim' ? 'class="border border-warning text-warning rounded-3 p-1 px-2"' : null; ?>
                                            <?= $transaction['status'] === 'selesai' ? 'class="border border-success text-success rounded-3 p-1 px-2"' : null; ?>
                                            >
                                            <?= $transaction['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                                            <?= $transaction['status'] === 'diproses' ? 'Diproses' : null; ?>
                                            <?= $transaction['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                                            <?= $transaction['status'] === 'selesai' ? 'Selesai' : null; ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Resi: $transaction['nomor_resi']</p>

                                    <div class="row">
                                        <div class="col-6 col-lg-2 text-center">
                                            <a href="/shiba-petshop/user/riwayat/detail.php?kode=<?= $transaction['kode_transaksi'] ?>">
                                                <button type="button" title="Show" class="btn btn-outline-dark rounded-pill"><i
                                                            class="bi bi-search"></i></button>
                                            </a>
                                        </div>
                                        <div class="col-6 col-lg-2 text-center">
                                            <a href="">
                                                <button type="button" title="Pay" class="btn btn-outline-dark rounded-pill"><i
                                                            class="bi bi-cash-coin"></i></button>
                                            </a>
                                        </div>
                                        <div class="col-8 col-lg-8"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</main>
<script>
    document.title = "Riwayat Transaksi"
</script>