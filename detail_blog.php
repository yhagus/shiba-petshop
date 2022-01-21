<?php
include 'navbar.php';

$id = $_GET['id'];
$result = $db->query("SELECT * FROM blog WHERE id_blog='$id'") or die(mysqli_error($db));
$blog =$result->fetch_assoc();
?>

<div class="container mt-5">
 

    <div class="shadow p-4 col-md-8 mx-auto">
        
    <div class="text-center">
    <h1 class="mb-5"><?php echo $blog['judul'] ?></h1>
    <br>
        <img class="img-fluid" src="assets/img/blog/<?php echo $blog['foto_blog'] ?>">
        <br>
    </div>

        <div class="mt-5">
        <i class="bi bi-calendar"></i>&nbsp;&nbsp;<?php echo tanggal($blog['tgl_blog']) ?>
        <br><br>
            <p class="text-left" style="font-size: 21px; ">
                <?php echo $blog['isi_blog'] ?>
            </p>
            <br><br><br>
            <a href="blog.php" class="text-white btn btn-sm bg-danger">kembali</a>
        </div>
    </div>
</div>

<script>
    document.title = "<?php echo $blog['judul'] ?>";
    document.getElementById("blog").classList.add("active");
</script>