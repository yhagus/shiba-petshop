<?php 
include 'api.php';


$id_provinsi = $_POST['id_provinsi'];
$kota = tampil_kota($id_provinsi);

 ?>

 <option value="">-Pilih Kota-</option>
 <?php foreach ($kota as $kota): ?>
 	<option value="<?php echo $kota['city_id']; ?>" kota_tujuan="<?php echo $kota['city_name'] ?>" kodepos="<?php echo $kota['postal_code'] ?>" tipe="<?php echo $kota['type'] ?>">
 		<?php echo $kota['type'];  ?>
 		<?php echo $kota['city_name'] ;?>
 	</option>
 	
 <?php endforeach ?>