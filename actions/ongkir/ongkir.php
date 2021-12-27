<?php 

include 'api.php';
$id_kota_tujuan = $_POST['id_kota'];
$total_berat = $_POST['total_berat'];
$kurir = $_POST['kurir'];



$ongkir = tampil_ongkir(419,$id_kota_tujuan,$kurir,$total_berat);
 

 ?>

<option value="pilih">-Pilih Ongkir-</option>
 <?php foreach ($ongkir as $ongkir): ?>
 	<option value="<?php echo $ongkir['service']; ?>"
 	biaya="<?php echo $ongkir['cost']['0']['value']; ?>"
 	estimasi="<?php echo $ongkir['cost']['0']['etd']; ?>"
 	desc="<?php echo $ongkir['service']." - ".$ongkir['description']; ?>"
	>
 		<?php echo $ongkir['service']; ?> - <?php echo $ongkir['description']; ?> 
 		<!-- Rp. <?php// echo number_format($ongkir['cost']['0']['value']); ?>
 		<?php //echo $ongkir['cost']['0']['etd']; ?> Hari -->
 	</option>
 	
 <?php endforeach ?> 