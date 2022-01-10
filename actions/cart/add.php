<?php 

include '../../config.php';

$id_user = $_SESSION['id'];
$id_produk = $_POST['id_produk'];
$qty= $_POST['qty'];
	

// cek jika barang sudah ada di keranjang
$res = $db->query("SELECT * FROM keranjang WHERE id_user='$id_user' AND id_produk='$id_produk' ");
$hitung_data = $res->num_rows;

if($hitung_data>0)
{
	$db->query("UPDATE keranjang SET jumlah = jumlah+'$qty' WHERE id_user='$id_user' AND id_produk='$id_produk' ");
}
else
{
	$db->query("INSERT INTO keranjang(id_user,id_produk,jumlah) VALUES ('$id_user','$id_produk','$qty') ");
}

echo "<script>alert('produk berhasil ditambahkan ke keranjang');location='../../user/cart.php';</script>";

?>