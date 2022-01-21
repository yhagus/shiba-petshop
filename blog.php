<?php 
include 'navbar.php';

$res = $db->query("SELECT * FROM blog ");

$jumlah_data_tabel = mysqli_num_rows($res);

if (!isset($_GET['page'])) 
{
	$halaman = 1;
} 
else 
{
	
$halaman = $_GET['page'];
}

$jumlah_data_perhalaman = 5;
$urutan_data = ($halaman - 1) * $jumlah_data_perhalaman;

//menentukan jumlah total halaman  
$total_halaman = ceil ($jumlah_data_tabel / $jumlah_data_perhalaman);  


$result = $db->query("SELECT * FROM blog ORDER BY id_blog LIMIT $urutan_data , $jumlah_data_perhalaman ");

while ( $data_blog = $result->fetch_assoc() ) 
{
 $blog[] = $data_blog;
}

 ?>


<div class="container mt-5">
	
	<?php foreach ($blog as $blogs): ?>

            <div class="row feature">
                <div class="col-md-7">
                <a href="detail_blog.php?id=<?php echo $blogs['id_blog'] ?>" class="text-decoration-none text-black">

                        <h3 class="feature-heading"><b><?php echo $blogs['judul'] ?></b></h3>
                    </a>
                    <br>
                    <p class="lead"><?php echo cut_blog_desc($blogs['isi_blog']) ?>.....</p>
                    <a href="detail_blog.php?id=<?php echo $blogs['id_blog'] ?>" class="text-decoration-none">selengkapnya</a>
                </div>
                <div class="col-md-5">
                <a href="detail_blog.php?id=<?php echo $blogs['id_blog'] ?>" class="text-decoration-none">
                    
                    <img  src="assets/img/blog/<?php echo $blogs['foto_blog'] ?>" class="img-fluid" height="80px">
                </a>

                    <!--  <svg class="bd-placeholder-img bd-placeholder-img-lg feature-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->

                </div>
            </div>

            <hr class="feature-divider">
        <?php endforeach ?>

        <br>
        <nav aria-label="Page navigation example">
			<ul class="pagination">
				
				<!-- prev page -->
				<?php if ($halaman!=1): ?>
					<li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $halaman-1 ?>">Previous</a></li>
				<?php endif ?>

				<?php for ($i=1; $i <= $total_halaman; $i++) { ?> 
				<li class="page-item <?php if($i == $halaman){echo 'active';} ?>"><a class="page-link" href="blog.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
				<?php } ?>
				
				<!-- next page -->
				<?php if ($halaman!=$total_halaman): ?>
					<li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $halaman+1 ?>">Next</a></li>
				<?php endif ?>

			</ul>
		</nav>

</div>

<script>
    document.title = "Blog";
    document.getElementById("blog").classList.add("active");
</script>