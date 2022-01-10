<?php

include "../navbar.php";
if (!isset($_SESSION['id'])) {
    redirect('/');
}

$id = $_SESSION['id'];
$result = $db->query("SELECT * FROM transaksi WHERE id_user='$id'");
$transactions = [];
while ($data = mysqli_fetch_assoc($result)){
    $transactions[] = $data;
}

?>
<main class="mt-4-5">
    <div class="container">
        <div class="row">
                <div class="col-8 card mx-auto">
                    <h1 class="display-6 mt-3">My Billing</h1>
                    <table class="table mt-2">
                        <thead>
                        <tr class="table-info">
                            <th scope="col">Invoice</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($transactions as $transaction) {
                            ?>
                            <tr>
                                <th scope="row"><?= $transaction['kode_transaksi']; ?></th>
                                <td><?= tanggal($transaction['tgl_transaksi']); ?></td>
                                <td>Rp. <?= $transaction['total_biaya']; ?>,-</td>
                                <td>
                                    <span
                                        <?= $transaction['status'] === 'selesai' ? 'class="badge rounded-pill bg-success"' : null;?>
                                        <?= $transaction['status'] === 'dikirim' ? 'class="badge rounded-pill bg-warning"' : null;?>
                                        <?= $transaction['status'] === 'diproses' ? 'class="badge rounded-pill bg-info"' : null;?>
                                        <?= $transaction['status'] === 'belum bayar' ? 'class="badge rounded-pill bg-danger"' : null;?>
                                    >
                                        <?= $transaction['status'] === 'selesai' ? 'Selesai' : null; ?>
                                        <?= $transaction['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                                        <?= $transaction['status'] === 'diproses' ? 'Diproses' : null; ?>
                                        <?= $transaction['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                                    </span>
                                </td>
                                <td class="mx-auto">
                                    <a href="<?php route('user/riwayat/detail.php?kode=' . $transaction['kode_transaksi']);?>">
                                        <button type="button" title="Show" class="btn btn-sm btn-outline-dark rounded-pill"><i
                                                    class="bi bi-search"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</main>
<script>
    document.title = "Riwayat Transaksi"
</script>