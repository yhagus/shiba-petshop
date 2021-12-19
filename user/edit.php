<?php
include '../navbar.php';

if (!isset($_SESSION['username'])){
    header("location: ../index.php");
}
?>

<main>

</main>

<?php
include '../footer.php';
?>
