<?php
require '../asset/functions.php';

$id = $_GET['id_blog'];
$blog = $conn->query("SELECT * FROM blog WHERE id_blog='$id'")->fetch_assoc();
$foto_lama = $blog['foto_blog'];


if(file_exists("../../assets/img/blog/$foto_lama"))
{
	unlink("../../assets/img/blog/$foto_lama");
}

$conn->query("DELETE FROM blog  WHERE id_blog='$id' ");
echo "<script>alert('Blog berhasil dihapus');location='index.php';</script>";