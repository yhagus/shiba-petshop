<?php

$host = "localhost";
$user = "root";
$pass = "root";
$database = "shiba_petshop";

$db = mysqli_connect($host,$user,$pass,$database);

if (!$db) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}