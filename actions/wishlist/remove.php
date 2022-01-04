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
$result = $db->query("DELETE FROM wishlist WHERE id_user='$id_user' AND id_produk='$id_produk'");
//var_dump($result);
redirect('catalog');