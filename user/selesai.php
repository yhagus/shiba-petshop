<?php 
include '../config.php';


if(!isset($_SESSION['id']))
{
	echo"<script>;location='../index.php'</script>";
}
else
{
	$id_user = $_SESSION['id'];
	$id_transaksi = $_GET['id'];

	$transaksi = $db->query("SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi' ")->fetch_assoc();
	$status = $transaksi['status'];
	$user_id = $transaksi['id_user'];

	if( $id_user == $user_id)
	{
	
		if($status == "dikirim")
		{
			$db->query("UPDATE transaksi SET status ='selesai' WHERE id_transaksi='$id_transaksi' ");
			echo"<script>alert('Transaksi berhasil diselesaikan, Terima kasih sudah berbelanja di Shiba Pet Shop');location='riwayat.php'</script>";
		}
		else
		{
			
			echo"<script>;location='riwayat.php'</script>";
		}

	}
	else
	{
		echo"<script>;location='../index.php'</script>";
	}


}

 ?>