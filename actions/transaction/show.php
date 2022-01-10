<?php 
include '../../config.php';

$result = $db->query("SELECT * FROM transaksi")
while ($data = $result->fetch_assoc()) {
	$krj[] = $data;
}




 ?>