<?php
require '../asset/functions.php';

$id_kategori = $_GET["id_kategori"];

if (hapus_kategori($id_kategori) > 0) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'kategori.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'kategori.php';
		</script>
	";
}
