<?php 

include '../../config.php';


unset($_POST['provinsi']);
unset($_POST['pilih_kota']);
unset($_POST['pilih_kurir']);
unset($_POST['pilih_layanan']);
unset($_POST['tampil_ongkir']);
unset($_POST['sama']);
unset($_POST['nama']);
unset($_POST['tlp']);
unset($_POST['addr']);

$tgl_trans = date("Ymd");
$id_user = $_SESSION['id'];
$status = "belum bayar";

$total_biaya = $_POST['total_biaya'];

// pengiriman
$kurir = $_POST['kurir'];
$biaya_ongkir = $_POST['ongkir'];
$nama_penerima = $_POST['nama_penerima'];
$telp_penerima = $_POST['telp_penerima'];
$kota_tujuan = $_POST['kota_tujuan'];
$alamat_tujuan = $_POST['alamat_tujuan'];


// echo(date("Ymd"))

// insert new trans
$db->query("INSERT INTO transaksi (id_user,tgl_transaksi,total_biaya,status) VALUES ('$id_user', '$tgl_trans', '$total_biaya', '$status')") or die(mysqli_error($db));
$id_trans = $db->insert_id;

$db->query("INSERT INTO pengiriman (id_transaksi,kurir,biaya_ongkir,nama_penerima,telp_penerima,kota_tujuan, alamat_tujuan) VALUES ('$id_trans', '$kurir', '$biaya_ongkir', '$nama_penerima','$telp_penerima','$kota_tujuan','$alamat_tujuan')") or die(mysqli_error($db));

if ($id_trans < 10 ) 
{
	$kode_trans = "TR00".$id_trans;
}
elseif($id_trans>=10 && $id_trans<100)
{
	$kode_trans = "TR0".$id_trans;	
}
elseif($id_trans>=100)
{
	$kode_trans = "TR".$id_trans;	
}

$db->query("UPDATE transaksi SET kode_transaksi='$kode_trans' WHERE id_transaksi='$id_trans' ");

// // cuma testing nanti diganti session keranjang
$result = $db->query("SELECT * FROM keranjang INNER JOIN produk ON produk.id_produk = keranjang.id_produk WHERE id_user='$id_user' ");
while ($data = $result->fetch_assoc()) {
	$krj[] = $data;
}



foreach ($krj as $krjg) 
{
	$id_produk = $krjg['id_produk'];
	$res = $db->query("SELECT * FROM produk WHERE id_produk ='$id_produk' ");
	$prod = $res->fetch_assoc();

	$nama_produk = $prod['nama_produk'];

	$harga = $krjg['harga_produk'];
	$jumlah = $krjg['jumlah'];
	
	$sub_total = $krjg['harga_produk'] * $krjg['jumlah'];

	$db->query("INSERT INTO detail_transaksi (id_transaksi,id_produk, produk, harga, jumlah, sub_total ) VALUES ('$id_trans', '$id_produk', '$nama_produk', '$harga', '$jumlah', '$sub_total')");

	$stok = $prod['stok'] - $jumlah; 
	$db->query("UPDATE produk SET stok='$stok' WHERE id_produk='$id_produk' ");
}

$db->query("DELETE FROM keranjang WHERE id_user='$id_user'");

echo "<script>alert('pemesanan berhasil, silakan lakukan pembayaran'); location='../../user/riwayat.php'</script>";


?>