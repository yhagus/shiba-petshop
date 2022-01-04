<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../config.php';

/*
 * METHODS
 */


$id_user = $_SESSION['id'];
$id_produk = $_GET['id_produk'];
$result = $db->query("INSERT INTO wishlist(id_user,id_produk) VALUES ('$id_user','$id_produk')");
//var_dump($result);

redirect('catalog');