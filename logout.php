<?php

include 'config.php';
session_unset();
session_destroy();

echo "<script>alert('logout Berhasil!');location='index.php'</script>";