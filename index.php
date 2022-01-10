<?php
include 'navbar.php';
$favorit = $db->query("SELECT COUNT(w.id_produk) as jumlah , w.id_produk, p.* FROM wishlist w INNER JOIN produk p ON w.id_produk=p.id_produk GROUP BY w.id_produk DESC")->fetch_assoc();
$terlaris = $db->query("SELECT COUNT(dt.id_produk) as jumlah , dt.id_produk, p.* FROM detail_transaksi dt INNER JOIN produk p ON dt.id_produk=p.id_produk GROUP BY dt.id_produk DESC")->fetch_assoc();;
$terbaru = $db->query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 1 ")->fetch_assoc();

?>

<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div> -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php asset('img/wallpaperdoge.jpg') ?>" width="100%">

                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Selamat Datang, .</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Marketing messaging and features
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <h2>Terfavorit</h2>
                <img src="<?php asset('img/produk/'.$favorit['foto_produk'])  ?>" class="bulet" width="140">

                <h4><?= $favorit['nama_produk'] ?></h4>
                <p>Difavoritkan oleh: <?= $favorit['jumlah'] ?> orang.</p>
                <p><a class="btn btn-secondary" href="detail.php?id=<?php echo $favorit['id_produk'] ?>">View details »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <h2>Terlaris</h2>
                <img src="<?php asset('img/produk/'.$terlaris['foto_produk'])  ?>" class="bulet" width="140">

                <h4><?= $terlaris['nama_produk'] ?></h4>
                <p>Terjual sebanyak <?= $terlaris['jumlah'] ?> kali.</p>
                <p><a class="btn btn-secondary" href="detail.php?id=<?php echo $terlaris['id_produk'] ?>">View details »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <h2>Terbaru</h2>
                <img src="<?php asset('img/produk/'.$terbaru['foto_produk'])  ?>" class="bulet" width="140">

                <h4><?= $terbaru['nama_produk'] ?></h4>
                <p>Produk terbaru.</p>
                <p><a class="btn btn-secondary" href="detail.php?id=<?php echo $terbaru['id_produk'] ?>">View details »</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURES -->

        <hr class="feature-divider">

        <div class="row feature">
            <div class="col-md-7">
                <h2 class="feature-heading">First feature heading. <span class="text-muted">It’ll blow your mind.</span></h2>
                <p class="lead">Some great placeholder content for the first feature here. Imagine some exciting prose here.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg feature-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

            </div>
        </div>

        <hr class="feature-divider">

        <div class="row feature">
            <div class="col-md-7 order-md-2">
                <h2 class="feature-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
                <p class="lead">Another feature? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <svg class="bd-placeholder-img bd-placeholder-img-lg feature-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

            </div>
        </div>

        <hr class="feature-divider">

        <div class="row feature">
            <div class="col-md-7">
                <h2 class="feature-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
                <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg feature-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

            </div>
        </div>

        <hr class="feature-divider">

        <!-- /END THE FEATURES -->

    </div><!-- /.container -->


</main>
<script>
    // document.title = "Shiba Petshop";
    document.title = "Home";
    document.getElementById("home").classList.add("active");
</script>

<?php
include 'footer.php';
?>
