<?php
include '../navbar.php';

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}

