<?php 

include '../../config.php';
include 'api.php';
$id_kota_tujuan = $_POST['id_kota'];
$total_berat = $_POST['total_berat'];
$total_belanja = $_POST['total_belanja'];
$kurir = $_POST['kurir'];



$ongkir = tampil_ongkir(419,$id_kota_tujuan,$kurir,$total_berat);
 

 ?>

<option value="pilih">-Pilih Ongkir-</option>
 <?php foreach ($ongkir as $ongkir): ?>
<?php 
$biaya_ongkir = $ongkir['cost']['0']['value'];
$total_biaya = $total_belanja+$biaya_ongkir;

 ?>


 	<option value="<?php echo $ongkir['service']; ?>"
 	biaya="<?php echo $biaya_ongkir; ?>"
 	tampil_ongkir="<?php  rp($biaya_ongkir); ?>"
 	tampil_total_biaya="<?php  rp($total_biaya); ?>"
 	estimasi="<?php echo $ongkir['cost']['0']['etd']; ?>"
 	desc="<?php echo $ongkir['service']." - ".$ongkir['description']; ?>"
 	serv="<?php echo $ongkir['service']; ?>"
	>
 		<?php echo $ongkir['service']; ?> - <?php echo $ongkir['description']; ?> 
 		<!-- Rp. <?php// echo number_format($ongkir['cost']['0']['value']); ?>
 		<?php //echo $ongkir['cost']['0']['etd']; ?> Hari -->
 	</option>
 	
 <?php endforeach ?> 