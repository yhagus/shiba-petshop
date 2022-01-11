<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "shiba_petshop");
// $db = mysqli_connect("localhost", "root", "", "shiba_petshop");

//tampil
function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

//users
function tambah_user($data)
{
	global $conn;

	$id_user = htmlspecialchars($data["id_user"]);
	$username = htmlspecialchars($data["username"]);
	$email = htmlspecialchars($data["email"]);
	$password = htmlspecialchars($data["password"]);
	$nama_user = htmlspecialchars($data["nama_user"]);
	$no_tlp = htmlspecialchars($data["no_tlp"]);
	$alamat_user = htmlspecialchars($data["alamat_user"]);


	$query = "INSERT INTO users
	VALUES
	('$id_user', '$username', 'user', '$email', '$password','$nama_user','$no_tlp','$alamat_user','')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_user($id_user)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");
	return mysqli_affected_rows($conn);
}


function cut_desc($kalimat)
{
	$exp_kalimat = explode(" ", $kalimat);

	$jumlah_kata = count($exp_kalimat);

	if ($jumlah_kata >= 10) {
		for ($i = 0; $i < 10; $i++) {
			$kata[] = $exp_kalimat[$i];
		}
	} else {
		for ($i = 0; $i <= $jumlah_kata - 1; $i++) {
			$kata[] = $exp_kalimat[$i];
		}
	}
	echo implode(" ", $kata);
}

function ubah_user($data)
{
	global $conn;

	$id_user = htmlspecialchars($data["id_user"]);
	$username = htmlspecialchars($data["username"]);
	$email = htmlspecialchars($data["email"]);
	$password = htmlspecialchars($data["password"]);
	$nama_user = htmlspecialchars($data["nama_user"]);
	$no_tlp = htmlspecialchars($data["no_tlp"]);
	$alamat_user = htmlspecialchars($data["alamat_user"]);


	$query = "UPDATE users SET
	username = '$username',
	role = 'user',
	email = '$email',
	password = '$password',
	nama_user = '$nama_user',
	no_tlp = '$no_tlp',
	alamat_user = '$alamat_user',
	foto_user = ''
	WHERE id_user = '$id_user'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari_user($keyword)
{
	$query = "SELECT * FROM users
	WHERE
	username LIKE '%$keyword%' OR
	email LIKE '%$keyword%' OR
	nama_user LIKE '%$keyword%' OR
	no_tlp LIKE '%$keyword%' OR
	alamat_user LIKE '%$keyword%' OR
	id_user LIKE '%$keyword%'
	";
	return query($query);
}

//kategori
function tambah_kategori($data)
{
	global $conn;

	$id_kategori = htmlspecialchars($data["id_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "INSERT INTO kategori
	VALUES
	('$id_kategori', '$nama_kategori')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_kategori($id_kategori)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id_kategori");
	return mysqli_affected_rows($conn);
}

function ubah_kategori($data)
{
	global $conn;

	$id_kategori = htmlspecialchars($data["id_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "UPDATE kategori SET
	nama_kategori = '$nama_kategori'
	WHERE id_kategori = '$id_kategori'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari_kategori($keyword)
{
	$query = "SELECT * FROM kategori
	WHERE
	nama_kategori LIKE '%$keyword%' OR
	id_kategori LIKE '%$keyword%'
	";
	return query($query);
}

function upload()
{

	$namaFile = $_FILES['foto_produk']['name'];
	$ukuranFile = $_FILES['foto_produk']['size'];
	$error = $_FILES['foto_produk']['error'];
	$tmpName = $_FILES['foto_produk']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
		alert('pilih gambar terlebih dahulu!');
	</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
	alert('yang anda upload bukan gambar!');
</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
	alert('ukuran gambar terlalu besar!');
</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/img/produk/' . $namaFileBaru);

	return $namaFileBaru;
}


//produk
function tambah_produk($data)
{
	global $conn;

	$id_produk = "";
	$id_kategori = htmlspecialchars($data["id_kategori"]);

	$nama_produk = htmlspecialchars($data["nama_produk"]);
	$harga_produk = htmlspecialchars($data["harga_produk"]);
	$stok = htmlspecialchars($data["stok"]);
	$berat = htmlspecialchars($data["berat"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);

	//upload gambar
	$foto_produk = upload();
	if (!$foto_produk) {
		return false;
	}


	$query = "INSERT INTO produk
	VALUES
	('$id_produk', '$id_kategori', '$nama_produk','$harga_produk','$stok','$berat','$deskripsi','$foto_produk')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_produk($id_produk)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
	return mysqli_affected_rows($conn);
}

function ubah_produk($data)
{
	global $conn;
	$id_produk = htmlspecialchars($data["id_produk"]);
	$id_kategori = htmlspecialchars($data["id_kategori"]);

	$nama_produk = htmlspecialchars($data["nama_produk"]);
	$harga_produk = htmlspecialchars($data["harga_produk"]);
	$stok = htmlspecialchars($data["stok"]);
	$berat = htmlspecialchars($data["berat"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$foto_produkLama = htmlspecialchars($data["foto_produkLama"]);

	// cek apakah user pilih foto_produk baru atau tidak
	if ($_FILES['foto_produk']['error'] === 4) {
		$foto_produk = $foto_produkLama;
	} else {
		$foto_produk = upload();
	}

	$query = "UPDATE produk SET
	id_kategori = '$id_kategori',

	nama_produk = '$nama_produk',
	harga_produk = '$harga_produk',
	stok = '$stok',
	berat = '$berat',
	deskripsi = '$deskripsi',
	foto_produk = '$foto_produk'
	WHERE id_produk = '$id_produk'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari_produk($keyword)
{
	$query = "SELECT * FROM produk
	WHERE
	id_kategori LIKE '%$keyword%' OR
	
	nama_produk LIKE '%$keyword%' OR
	harga_produk LIKE '%$keyword%' OR
	stok LIKE '%$keyword%' OR
	berat LIKE '%$keyword%' 
	";
	return query($query);
}


// ----------------transaksi-----------

function tampil_transaksi()
{
	$data = [];
	$result = $conn->query("SELECT * FROM transaksi");
	while ($data = $result->fetch_assoc()) {
		$data[] = $data;
	}
	return $data;
}

function detail_transaksi($id)
{
	$data = [];
	$result = $conn->query("SELECT * FROM transaksi WHERE id_transaksi='$id'  ");
	while ($data = $result->fetch_assoc()) {
		$data[] = $data;
	}
	return $data;
}



function tanggal($tanggal)
{
	$tgl = explode("-", $tanggal);
	$bln["01"] = "Januari";
	$bln["02"] = "Februari";
	$bln["03"] = "Maret";
	$bln["04"] = "April";
	$bln["05"] = "Mei";
	$bln["06"] = "Juni";
	$bln["07"] = "Juli";
	$bln["08"] = "Agustus";
	$bln["09"] = "September";
	$bln["10"] = "Oktober";
	$bln["11"] = "November";
	$bln["12"] = "Desember";
	if ($tgl[0] == "0000") {
		return $tanggal;
	} else {
		return abs($tgl[2]) . " " . $bln[$tgl[1]] . " " . $tgl[0];
	}
}

function rp($harga)
{
	echo "Rp " . str_replace(",", ".", number_format($harga));
}
