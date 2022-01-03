<?php
require '../asset/functions.php';

$id_produk = $_GET["id_produk"];

if (hapus_produk($id_produk) > 0) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'produk.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'produk.php';
		</script>
	";
}
