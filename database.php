<?php
date_default_timezone_set("Asia/Jakarta");

$host = "localhost";
$user = "root";
$pass = "";
$database = "shiba_petshop";

$db = mysqli_connect($host,$user,$pass,$database);

if (!$db) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}