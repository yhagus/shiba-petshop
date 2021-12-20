<?php 
// $_SESSION['id']
include '../../config.php';

echo "<pre>";
print_r ($_SESSION);
echo "</pre>";


$id_user = $_SESSION['id'];

$res = $db->query("SELECT * FROM keranjang INNER JOIN produk ON keranjang.id_produk = produk.id_produk  WHERE id_user='$id_user' ");
while ($data = $res->fetch_assoc()) {
	$keranjang[] = $data;
}

echo "<pre>";
print_r ($keranjang);
echo "</pre>";
 ?>