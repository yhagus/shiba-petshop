<?php 

include '../../config.php';

	$id_user = $_SESSION['id'];
	$id_produk = $_POST['id_produk'];
	$qty= $_POST['qty'];
	// $db->

	echo "<pre>";
	print_r ($id_user);
	print_r ($id_produk);
	print_r ($qty);
	echo "</pre>";

	// cek jika barang sudah ada di keranjang
	$res = $db->query("SELECT * FROM keranjang WHERE id_user='$id_user' AND id_produk='$id_produk' ");
	$hitung_data = $res->num_rows;
	
if($hitung_data>0)
{

}
else
{
	
}

 ?>