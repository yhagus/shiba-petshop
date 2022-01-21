<?php 
include '../../config.php';
if(isset($_POST))
{

	$id_transaksi = $_POST['id_transaksi'];
	$waktu_pembayaran = date("Y-m-d H:i:s");

	$tmp = $_FILES['bukti_transfer']['tmp_name'];
	$file_name = date("dmy_His_").$_FILES['bukti_transfer']['name'];

	$size = $_FILES['bukti_transfer']['size'];
	$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

	if ($size > 3000000) {
		echo "Sorry, your file is too large.";
	}

	if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {

		echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.');window.history.go(-1);</script>";
	}
	else
	{
		if(move_uploaded_file($tmp, "../../assets/img/bukti_transfer/$file_name"))
		{

			$status ="diproses";

			$db->query("INSERT INTO pembayaran (id_transaksi,waktu_pembayaran,bukti_transfer) VALUES ('$id_transaksi', '$waktu_pembayaran', '$file_name') ");
			$db->query("UPDATE transaksi SET status='$status' WHERE id_transaksi='$id_transaksi' ");

			echo "<script>alert('Terima kasih sudah melakukan pembayaran, Pesananmu akan segera diproses');window.history.go(-1);</script>";
			
		}
	}
}

?>


<!-- <img src="../../assets/img/bukti_transfer/blog1.jpg"> -->