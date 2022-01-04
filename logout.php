<?php

session_start();
session_unset();
session_destroy();

echo "<script>alert('logout Berhasil!');location='index.php'</script>";