<?php
/*
 * INITIALIZE CONFIG
 * DATABASE, SESSION_START, ETC
 */
include '../../../config.php';

/*
 * METHODS
 */

if(isset($_POST['removeItem'])){
    $id = $_GET['id_cart'];
    $result = $db->query("DELETE FROM keranjang WHERE id_keranjang='$id'");
    if ($result){
        $_SESSION['swal'] = [
            "icon" => "success",
            "title" => "Berhasil remove item"
        ];
    } else{
        $_SESSION['swal'] = [
            "icon" => "error",
            "title" => "Gagal remove item"
        ];
    }
}
header("location: /shiba-petshop/user/cart.php");