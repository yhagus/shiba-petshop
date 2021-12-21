<?php 

include 'navbar.php';
?>
<main>
    <div class="pd-wrap mt-xl-3">
        <div class="container">
            <?php
            // ambil id dari url
            $id_produk = $_GET['id'];
            // ambil data produk berdasar idnya
            $result = $db->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $produk = $result->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid img-produk" src="assets/img/produk/<?php echo $produk['foto_produk'] ?>" />   
                </div>
                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                        <!-- menampilkan nama produk -->
                            <div class="product-name"><?php echo $produk['nama_produk'] ?></div>
                            <div class="product-price-discount"><span>Rp <?php echo $produk['harga_produk'] ?></span></div>
                        </div>
                        <!-- tampil deskripsi -->
                        <p><?php echo $produk['deskripsi'] ?></p>

                        <!-- tampil berat produk satuannya gram -->
                        <p>Berat produk: <?php echo $produk['berat'] ?> gram</p>
                        <div class="row">
                            <div class="col-md-6">
                            <!-- tampil stok produk -->
                                <label for="size">Stok</label>
                                <input type="text" class="form-control stok" value="<?php echo $produk['stok'] ?>" disabled>
                            </div>
                        </div>
                        <div class="product-count">
                            <label for="size">Quantity</label>
                            <form action="actions/cart/add.php" method="POST" >
                                <div class="display-flex">
                                <!-- jumlah produk -->
                                <!-- user gak bisa beli melebihi stok -->
                                    <div class="qtyminus">-</div>
                                    <input type="number" name="qty" value="1" class="qty" readonly="" >
                                    <div class="qtyplus">+</div>
                                </div>
                                <input type="" placeholder="id produk" name="id_produk" value="<?php echo $id_produk ?>" hidden>

                                <!-- jika user udah login tombol tambah ke keranjang bisa diklik-->
                                <?php if (isset($_SESSION['id'])): ?>
                                    
                                <button class="round-black-btn btndi text-decoration-none" type="submit" name="add_cart">Add to Cart</button>
                                <?php else: ?>
                                    <!-- jika user belum login tombol tambah ke keranjang gk bisa diklik dan disuruh login-->
                                <button class="round-black-btn btndi text-decoration-none disabled" disabled="" title="silakan login untuk membeli produk"  type="">Add to Cart</button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>