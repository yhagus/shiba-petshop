<?php

include "../navbar.php";
if (!isset($_SESSION['id'])) {
    redirect('/');
}

$id = $_SESSION['id'];
$result = $db->query("SELECT * FROM transaksi INNER JOIN pengiriman ON transaksi.id_transaksi = pengiriman.id_transaksi WHERE id_user='$id'");
$transactions = [];
while ($data = mysqli_fetch_assoc($result)){
    $transactions[] = $data;
}

?>
<main class="mt-4-5">
    <div class="container">

        <div class="row">
            <div class="col text-end">
                <div>
                    <a href="<?php route('/');?>" class="text-decoration-none">Home</a> > Riwayat
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8 card mx-auto">
                <h1 class="display-6 mt-3">My Transaction</h1>
                <table class="table mt-2">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Invoice</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th>Resi</th>
                            <th class="text-center" width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($transactions as $transaction) {
                            ?>
                            <tr>
                                <th scope="row"><?= $transaction['kode_transaksi']; ?></th>
                                <td><?= tanggal($transaction['tgl_transaksi']); ?></td>
                                <td><?= rp($transaction['total_biaya']); ?>,-</td>
                                <td>
                                    <span
                                    <?= $transaction['status'] === 'selesai' ? 'class="badge rounded-pill bg-success"' : null;?>
                                    <?= $transaction['status'] === 'dikirim' ? 'class="badge rounded-pill bg-warning"' : null;?>
                                    <?= $transaction['status'] === 'terverifikasi' ? 'class="badge rounded-pill bg-primary"' : null;?>
                                    <?= $transaction['status'] === 'diproses' ? 'class="badge rounded-pill bg-info"' : null;?>
                                    <?= $transaction['status'] === 'belum bayar' ? 'class="badge rounded-pill bg-danger"' : null;?>
                                    >
                                    <?= $transaction['status'] === 'selesai' ? 'Selesai' : null; ?>
                                    <?= $transaction['status'] === 'dikirim' ? 'Dikirim' : null; ?>
                                    <?= $transaction['status'] === 'terverifikasi' ? 'Pembayraran terverifikasi' : null; ?>
                                    <?= $transaction['status'] === 'diproses' ? 'Diproses' : null; ?>
                                    <?= $transaction['status'] === 'belum bayar' ? 'Belum Bayar' : null; ?>
                                </span>
                            </td>
                                <td><?php echo $transaction['no_resi'] ?></td>
                            <td class="mx-auto text-center">
                                <a class="me-1 text-decoration-none" href="<?php route('user/riwayat/detail.php?kode=' . $transaction['kode_transaksi']);?>">
                                    <button type="button" title="Detail" class="btn btn-sm btn-outline-dark rounded-pill"><i
                                        class="bi bi-search"></i></button>
                                    </a>

                                    <?php if ($transaction['status'] == "dikirim" ): ?>
                                        
                                        <button type="button" title="Lacak Resi" class="btn btn-sm btn-outline-dark rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#lacak" ><i
                                        class="bi bi-truck"></i></button>
                                        <button  title="Selesai" class="btn btn-sm btn-outline-dark rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#lacak" ><i
                                        class="bi bi-check2-all"></i></button>
                                        
                                    <?php endif ?>

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


    <div class="modal fade" id="lacak" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imgModalLabel">Lacak Resi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    

                   <div id="cekresicom_id"></div>
                   


               </div>
           </div>
       </div>
   </div>



</main>
<script>
    document.title = "Riwayat Transaksi"
</script>
<script type="text/javascript" src="https://cekresi.com/widget/widgetcekresicom_v1.js"></script>
<script type="text/javascript">
    init_widget_cekresicom('w1',380,110)
</script>