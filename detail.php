<?php 

include 'navbar.php';
?>
<main>
    <div class="pd-wrap mt-xl-3">
        <div class="container">
            <?php
            $id_produk = $_GET['id'];
            $result = $db->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $produk = $result->fetch_assoc();
// echo "<pre>";
// print_r ($produk);
// echo "</pre>";

            ?>
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid img-produk" src="assets/img/produk/<?php echo $produk['foto_produk'] ?>" />   
                </div>
                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name"><?php echo $produk['nama_produk'] ?></div>
                            <div class="product-price-discount"><span>Rp <?php echo $produk['harga_produk'] ?></span></div>
                        </div>
                        <p><?php echo $produk['deskripsi'] ?></p>
                        <p>Berat produk: <?php echo $produk['berat'] ?> gram</p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="size">Stok</label>
                                <input type="text" class="form-control stok" value="<?php echo $produk['stok'] ?>" disabled>
                            </div>
                        </div>
                        <div class="product-count">
                            <label for="size">Quantity</label>
                            <form action="actions/user/cart.php" method="POST" >
                                <div class="display-flex">
                                    <div class="qtyminus">-</div>
                                    <input type="number" name="qty" value="1" class="qty" readonly="" max="5">
                                    <div class="qtyplus">+</div>
                                </div>
                                    <button class="round-black-btn btndi text-decoration-none" type="submit" name="add_cart">Add to Cart</button>
                            </form>
                       
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>