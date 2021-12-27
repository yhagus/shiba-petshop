<?php

include 'database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function tanggal($tanggal)
{
    $tgl = explode("-", $tanggal);
    $bln["01"]="Januari";
    $bln["02"]="Februari";
    $bln["03"]="Maret";
    $bln["04"]="April";
    $bln["05"]="Mei";
    $bln["06"]="Juni";
    $bln["07"]="Juli";
    $bln["08"]="Agustus";
    $bln["09"]="September";
    $bln["10"]="Oktober";
    $bln["11"]="November";
    $bln["12"]="Desember";
    if ($tgl[0]=="0000")
    {
        return $tanggal;
    }
    else
    {
        return $tgl[2]." ".$bln[$tgl[1]]." ".$tgl[0];
    }
}