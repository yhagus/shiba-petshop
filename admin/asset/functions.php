<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "shiba_petshop");

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
			  ('$id_user', '$username', '$email', '$password','$nama_user','$no_tlp','$alamat_user')
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
				email = '$email',
				password = '$password',
				nama_user = '$nama_user',
				no_tlp = '$no_tlp',
				alamat_user = '$alamat_user'
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

	move_uploaded_file($tmpName, '../asset/img/' . $namaFileBaru);

	return $namaFileBaru;
}


//produk
function tambah_produk($data)
{
	global $conn;

	$id_produk = htmlspecialchars($data["id_produk"]);
	$id_kategori = htmlspecialchars($data["id_kategori"]);
	$kode_produk = htmlspecialchars($data["kode_produk"]);
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
			  ('$id_produk', '$id_kategori', '$kode_produk', '$nama_produk','$harga_produk','$stok','$berat','$deskripsi','$foto_produk')
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
	$kode_produk = htmlspecialchars($data["kode_produk"]);
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
				kode_produk = '$kode_produk',
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
			  kode_produk LIKE '%$keyword%' OR
			  nama_produk LIKE '%$keyword%' OR
			  harga_produk LIKE '%$keyword%' OR
			  stok LIKE '%$keyword%' OR
			  berat LIKE '%$keyword%' 
			";
	return query($query);
}